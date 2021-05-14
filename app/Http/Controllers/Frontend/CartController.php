<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cart;
use App\model\Product;
use App\model\PaymentCheckoutCustomer;
use App\model\ShipmentCustomer;
use App\model\ProductCartCustomer;
use App\model\OrderCustomer;

use Session;
use Auth;
use Carbon\Carbon;
use Validator;

class CartController extends Controller
{   
    public function __construct(){
        $this->middleware('auth:member');
    }
    
    public function getAddToCart(Request $request, $id, $qty ) {
        if($qty == 0) {
            $request->session()->flash('alert-danger', 'กรุณาเลือกจำนวนสินค้าที่ต้องการซื้อ จำนวนสินค้าต้องไม่เป็น 0');
            return back();
        } else {
            $product = Product::findOrFail($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id, $qty);
            $request->session()->put('cart', $cart);    

            return redirect()->route('cart.index', ['id' => $product->id]);
        }
    }

    public function getCart() {

        if (!Session::has('cart')) {
            if(\Session::get('locale') == null)
                $productRecommends = Product::where('product_recommend','ใช่')->where('status','แสดงสินค้า')->get();
            else 
                $productRecommends = Product::where('product_recommend','ใช่')->where('status','แสดงสินค้า')->select('id','brand_id','phone_model_id','product_name_'.\Session::get('locale'))->get();

                return view('/frontend/cart/shopping-cart',['products' => 'null','productRecommends' => $productRecommends]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('/frontend/cart/shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);   
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0 ) {
            Session::put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }
        
        return redirect()->route('cart.index');
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('/frontend/cart/shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('/frontend/cart/checkout', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'total' => $total]);
    }

    public function paymentCheckoutCustomer(Request $request){
        $validator = Validator::make($request->all(), $this->rules_paymentCheckoutCustomer(), $this->messages_paymentCheckoutCustomer());
        if($validator->passes()) {
            $customer_id = Auth::guard('member')->user()->id;

            $name = $request->get('name');
            $phone = $request->get('phone');
            $phone_sec = $request->get('phone_sec');
            $address = $request->get('address');
            $district = $request->get('district');
            $amphoe = $request->get('amphoe');
            $province = $request->get('province');
            $zipcode = $request->get('zipcode');

            $product = $request->get('product');
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
            $bill_number = '#';
            for ($i = 0; $i < 8; $i++) {
                $bill_number .= $characters[rand(0, $charactersLength - 1)];
            }

            $payment_checkout_customer = new PaymentCheckoutCustomer;
            $payment_checkout_customer->customer_id = $customer_id;
            $payment_checkout_customer->bill_number = $bill_number;
            $payment_checkout_customer->payday = $payday;
            $payment_checkout_customer->time = $time;
            $payment_checkout_customer->money = $money;

            if($request->hasFile('slip')){
                $slip = $request->file('slip');
                $filename = md5(($slip->getClientOriginalName(). time()) . time()) . "_o." . $slip->getClientOriginalExtension();
                $slip->move('image_upload/payment_customer/', $filename);
                $path = 'image_upload/payment_customer/'.$filename;
                $payment_checkout_customer->slip = $filename;
                $payment_checkout_customer->save();
            }

            $payment_checkout_customer->save();

            $shipment_customer = new ShipmentCustomer;
            $shipment_customer->customer_id = $customer_id;
            $shipment_customer->bill_number = $bill_number;
            $shipment_customer->name = $name;
            $shipment_customer->phone = $phone;
            $shipment_customer->phone_sec = $phone_sec;
            $shipment_customer->address = $address;
            $shipment_customer->district = $district;
            $shipment_customer->amphoe = $amphoe;
            $shipment_customer->province = $province;
            $shipment_customer->zipcode = $zipcode;
            $shipment_customer->save();

            for ($i=0; $i < count($product) ; $i++) { 
                $product_cart_customer = new ProductCartCustomer;
                $product_cart_customer->customer_id = $customer_id;
                $product_cart_customer->bill_number = $bill_number;
                $product_cart_customer->product_id = $product_id[$i];
                $product_cart_customer->price = $price[$i];
                $product_cart_customer->qty = $qty[$i];
                $product_cart_customer->save();
            }

            $payment_id = PaymentCheckoutCustomer::where('bill_number',$bill_number)->value('id');
            $shipment_id = ShipmentCustomer::where('bill_number',$bill_number)->value('id');
            $product_carts = ProductCartCustomer::where('bill_number',$bill_number)->get();

            $date = Carbon::now()->format('d/m/Y');

            foreach($product_carts as $product_cart => $value) {
                $order_customer = new OrderCustomer;
                $order_customer->customer_id = $customer_id;
                $order_customer->bill_number = $bill_number;
                $order_customer->payment_id = $payment_id;
                $order_customer->shipment_id = $shipment_id;
                $order_customer->product_cart_id = $value->id;
                $order_customer->date = $date;
                $order_customer->save();
            }

            Session::forget('cart');
            $request->session()->flash('alert-success', 'แจ้งชำระเงินสำเร็จ');
            $customer_id = Auth::guard('member')->user()->id;
            $orders = OrderCustomer::where('customer_id',$customer_id)->groupBY('bill_number')->orderBy('id','asc')->get();
            $productRecommends = Product::where('product_recommend','ใช่')->orderBy('id','asc')->get();
            return view('/frontend/account/order-history')->with('orders',$orders)
                                                          ->with('productRecommends',$productRecommends);
        } else {
            $request->session()->flash('alert-danger', 'แจ้งชำระเงินไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    // Validate
    public function rules_paymentCheckoutCustomer() {
        return [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
            'payday' => 'required',
            'time' => 'required',
            'money' => 'required',
            'slip' => 'required',
        ];
    }

    public function messages_paymentCheckoutCustomer() {
        return [
            'name.required' => 'กรุณากรอกชื่อและนามสกุล',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'address.required' => 'กรุณากรอกที่อยู่',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
            'payday.required' => 'กรุณากรอกวันที่ชำระเงิน',
            'time.required' => 'กรุณากรอกเวลาที่ชำระเงิน',
            'money.required' => 'กรุณากรอกจำนวนเงินที่ชำระ',
            'slip.required' => 'กรุณาแนบหลักฐานการโอนเงิน',
        ];
    }
}
