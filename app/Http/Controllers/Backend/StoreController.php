<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Serialnumber;
use App\model\ProductOut;
use App\model\MessageStore;
use App\model\StockFilm;
use App\model\FilmPriceStore;
use App\model\ProductCartSessionStore;
use App\model\PaymentCheckoutStore;
use App\model\ShipmentStore;
use App\model\ProductCartStore;
use App\model\OrderStore;

use Validator;
use Auth;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth:store');
    }

    /////////////////////////////// รายการสินค้าออก ///////////////////////////////
    public function productOut(Request $request){
        $NUM_PAGE = 20;
        $product_outs = ProductOut::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/member-store/manageOrderProduct/product-out')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('product_outs',$product_outs);
    }

    public function productOutPost(Request $request){
        $validator = Validator::make($request->all(), $this->rules_productOutPost(), $this->messages_productOutPost());
        if($validator->passes()) {
            $serialnumber = $request->get('serialnumber');
            $film_model_id = Serialnumber::where('serialnumber',$serialnumber)->value('id');
            if($film_model_id == null) {
                $request->session()->flash('alert-danger', 'หมายเลขซีเรียล 16 หลัก ไม่ถูกต้อง');
                return back();
            } else {
                $product_out = new ProductOut;
                $product_out->film_model_id = $film_model_id;
                $product_out->serialnumber = $serialnumber;
                $product_out->save();

                $serialnumber_status = Serialnumber::findOrFail($film_model_id);
                $serialnumber_status->status = 'ใช้งานแล้ว';
                $serialnumber_status->update();
                $request->session()->flash('alert-success', 'นำสินค้าออกสำเร็จ');
                return back();
            }
        }
        else {
            $request->session()->flash('alert-danger', 'นำสินค้าออกไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    // ติดต่อสอบถาม
    public function contactUs(){
        return view('backend/member-store/contact/contact-us');
    }

    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(), $this->rules_sendMessage(), $this->messages_sendMessage());
        if($validator->passes()) {
            $message = $request->all();
            $message = MessageStore::create($message);
            $request->session()->flash('alert-success', 'ส่งข้อความติดต่อสำเร็จ รอการติดต่อกลับ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'ส่งข้อความติดต่อไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function messageHistory(Request $request){
        $NUM_PAGE = 20;
        $messages = MessageStore::where('store_id',Auth::guard('store')->user()->id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/member-store/contact/message-history')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('messages',$messages);
    }

    // สั่งซื้อสินค้า
    public function orderProduct(Request $request){
        $NUM_PAGE = 20;
        $stock_films = FilmPriceStore::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/member-store/order/order-product')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('stock_films',$stock_films);
    }

    public function getAddToCart(Request $request) {
        $product_cart_session = $request->all();
        $product_cart_session = ProductCartSessionStore::create($product_cart_session);
        return redirect()->action('Backend\StoreController@getCart');
    }

    public function getCart(Request $request){
        $NUM_PAGE = 20;
        $product_cart_sessions = ProductCartSessionStore::where('store_id',Auth::guard('store')->user()->id)->paginate($NUM_PAGE);
        $count_cart = count($product_cart_sessions);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/member-store/order/shopping-cart')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('product_cart_sessions',$product_cart_sessions)
                                                               ->with('count_cart',$count_cart);
    }

    public function removeShoppingCart($id){
        $shopping_cart = ProductCartSessionStore::findOrFail($id);
        $shopping_cart->delete();
        return back();
    }

    public function getCheckout(){
        $product_cart_sessions = ProductCartSessionStore::where('store_id',Auth::guard('store')->user()->id)->get();
        $count_cart = count($product_cart_sessions);
        return view('backend/member-store/order/checkout')->with('product_cart_sessions',$product_cart_sessions)
                                                          ->with('count_cart',$count_cart);
    }

    public function paymentCheckoutStore(Request $request){
        $store_id = Auth::guard('store')->user()->id;

        $name = $request->get('name');
        $phone = $request->get('phone');
        $phone_sec = $request->get('phone_sec');
        $address = $request->get('address');
        $district = $request->get('district');
        $amphoe = $request->get('amphoe');
        $province = $request->get('province');
        $zipcode = $request->get('zipcode');

        $price = $request->get('price');
        $qty = $request->get('qty');
        $product_id = $request->get('product_id');

        $payday = $request->get('payday');
        $time = $request->get('time');
        $money = $request->get('money');
        $slip = $request->file('slip');

        $date = Carbon::now()->format('d/m/Y');
        
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $bill_number = '#S';
        for ($i = 0; $i < 7; $i++) {
            $bill_number .= $characters[rand(0, $charactersLength - 1)];
        }

        $payment_checkout_store = new PaymentCheckoutStore;
        $payment_checkout_store->store_id = $store_id;
        $payment_checkout_store->bill_number = $bill_number;
        $payment_checkout_store->payday = $payday;
        $payment_checkout_store->time = $time;
        $payment_checkout_store->money = $money;

        if($request->hasFile('slip')){
            $slip = $request->file('slip');
            $filename = md5(($slip->getClientOriginalName(). time()) . time()) . "_o." . $slip->getClientOriginalExtension();
            $slip->move('image_upload/payment_store/', $filename);
            $path = 'image_upload/payment_store/'.$filename;
            $payment_checkout_store->slip = $filename;
            $payment_checkout_store->save();
        }

        $payment_checkout_store->save();

        $shipment_store = new ShipmentStore;
        $shipment_store->store_id = $store_id;
        $shipment_store->bill_number = $bill_number;
        $shipment_store->name = $name;
        $shipment_store->phone = $phone;
        $shipment_store->phone_sec = $phone_sec;
        $shipment_store->address = $address;
        $shipment_store->district = $district;
        $shipment_store->amphoe = $amphoe;
        $shipment_store->province = $province;
        $shipment_store->zipcode = $zipcode;
        $shipment_store->save();

        for ($i=0; $i < count($product_id) ; $i++) { 
            $product_cart_store = new ProductCartStore;
            $product_cart_store->store_id = $store_id;
            $product_cart_store->bill_number = $bill_number;
            $product_cart_store->product_id = $product_id[$i];
            $product_cart_store->price = $price[$i];
            $product_cart_store->qty = $qty[$i];
            $product_cart_store->save();
        }

        $payment_id = PaymentCheckoutStore::where('bill_number',$bill_number)->value('id');
        $shipment_id = ShipmentStore::where('bill_number',$bill_number)->value('id');
        $product_carts = ProductCartStore::where('bill_number',$bill_number)->get();

        $date = Carbon::now()->format('d/m/Y');

        foreach($product_carts as $product_cart => $value) {
            $order_store = new OrderStore;
            $order_store->store_id = $store_id;
            $order_store->bill_number = $bill_number;
            $order_store->payment_id = $payment_id;
            $order_store->shipment_id = $shipment_id;
            $order_store->product_cart_id = $value->id;
            $order_store->date = $date;
            $order_store->save();
        }

        $product_cart_session = ProductCartSessionStore::where('product_id',$product_id)
                                                        ->where('store_id',$store_id)->delete();

        return redirect()->action('Backend\StoreController@orderHistory');
    }

    // ประวัติการสั่งซื้อสินค้า
    public function orderHistory(){
        $store_id = Auth::guard('store')->user()->id;
        $orders = OrderStore::where('store_id',$store_id)->groupBY('bill_number')->get();
        return view('backend/member-store/order/order-history')->with('orders',$orders);
    }

    public function orderHistoryDetail($id){
        $order = OrderStore::findOrFail($id);
        return view('backend/member-store/order/order-history-detail')->with('order',$order);
    }

    public function rules_productOutPost() {
        return [
            'serialnumber' => 'required',
        ];
    }

    public function messages_productOutPost() {
        return [
            'serialnumber.required' => 'กรุณากรอกหมายเลขซีเรียล 16 หลัก',
        ];
    }

    public function rules_sendMessage() {
        return [
            'subject' => 'required',
            'message' => 'required',
        ];
    }

    public function messages_sendMessage() {
        return [
            'subject.required' => 'กรุณากรอกหัวข้อเรื่อง',
            'message.required' => 'กรุณากรอกข้อความที่ต้องการส่ง',
        ];
    }
}
