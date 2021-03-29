<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Product;
use App\model\StockFilm;
use App\model\ProductFilmInformation;
use App\model\ProductPrice;
use App\model\Serialnumber;
use App\model\ProductOut;
use App\model\DataWarrantyMember;
use App\model\WarrantyConfirm;
use App\model\OrderCustomer;

use Validator;

class SellerController extends Controller
{
    public function __construct(){
        $this->middleware('auth:seller');
    }

    /////////////////////////////// จัดการคลังสินค้า ///////////////////////////////
    public function listProduct(Request $request){
        $NUM_PAGE = 20;
        $products = Product::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProduct/list-product')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('products',$products);
    }

    public function listProductPrice(Request $request){
        $NUM_PAGE = 20;
        $products = Product::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/list-product-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                           ->with('page',$page)
                                                                           ->with('products',$products);
    }

    public function editProductPrice($id){
        $product = Product::findOrFail($id);
        return view('backend/seller/manageProductPrice/edit-product-price')->with('product',$product);
    }

    public function updateProductPrice(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateProductPrice(), $this->messages_updateProductPrice());
        if($validator->passes()) {
            $price = $request->all();
            $price = ProductPrice::create($price);
            $request->session()->flash('alert-success', 'อัพโหลดราคาสำเร็จ');
            return redirect()->action('Backend\SellerController@listProductPrice');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดราคาไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function ProductPriceDetail(Request $request,$id){
        $NUM_PAGE = 20;
        $product_prices = ProductPrice::where('product_id',$id)->orderBy('id','asc')->paginate($NUM_PAGE);
        $product = Product::where('id',$id)->value('product_name');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/product-price-detail')->with('NUM_PAGE',$NUM_PAGE)
                                                                             ->with('page',$page)
                                                                             ->with('product_prices',$product_prices)
                                                                             ->with('product',$product);
    }

    /////////////////////////////// จัดการสต๊อกสินค้า ///////////////////////////////
    public function manageFilmStock(Request $request){
        $NUM_PAGE = 20;
        $stock_films = StockFilm::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageStock/film-stock')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('stock_films',$stock_films);
    }

    public function filmStockOut(Request $request){
        $id = $request->get('id');
        $amount_out = $request->get('amount');
        $amount = StockFilm::where('id',$id)->value('amount');
        $amount -= $amount_out;
        $amount = StockFilm::where('id',$id)->update(['amount' =>  $amount]);
        return back();
    }

    public function filmStockAdd(Request $request){
        $id = $request->get('id');
        $amount_add = $request->get('amount');
        $amount = StockFilm::where('id',$id)->value('amount');
        $amount += $amount_add;
        $amount = StockFilm::where('id',$id)->update(['amount' =>  $amount]);
        return back();
    }

    /////////////////////////////// จัดการออเดอร์ การสั่งซื้อ รายการสินค้าออก ///////////////////////////////
    public function productOut(Request $request){
        $NUM_PAGE = 20;
        $product_outs = ProductOut::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/product-out')->with('NUM_PAGE',$NUM_PAGE)
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

    public function deleteProductOut($id){
        $product_out = ProductOut::findOrFail($id);
        $product_out->delete();
        return back();
    }

    public function orderCustomer(Request $request){
        $NUM_PAGE = 20;
        $orders = OrderCustomer::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/order-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('orders',$orders);
    }

    public function orderCustomerDetail($id){
        $order = OrderCustomer::findOrFail($id);
        return view('backend/seller/manageOrderProduct/order-customer-detail')->with('order',$order);
    }

    /////////////////////////////// ข้อมูลการลงทะเบียน และข้อมูลการเคลมสินค้า ///////////////////////////////
    public function dataWarranty(Request $request){
        $NUM_PAGE = 20;
        $data_warrantys = DataWarrantyMember::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/data-warranty-member')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('data_warrantys',$data_warrantys);
    }

    public function deleteDataWarranty($id){
        $warranty_confirm = WarrantyConfirm::where('warranty_id',$id)->delete();
        $data_warranty = DataWarrantyMember::findOrFail($id);
        $data_warranty->delete();
        return redirect()->action('Backend\SellerController@dataWarranty');
    }

    public function editDataWarranty(Request $request, $id){
        $NUM_PAGE = 20;
        $data_warranty = DataWarrantyMember::findOrFail($id);
        $data_warrantys = DataWarrantyMember::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/edit-data-warranty')->with('NUM_PAGE',$NUM_PAGE)
                                                                     ->with('page',$page)
                                                                     ->with('data_warrantys',$data_warrantys)
                                                                     ->with('data_warranty',$data_warranty);
    }

    public function updateDataWarranty(Request $request){
        $warranty_id = $request->get('id');
        $status = $request->get('status');
            $warranty = new WarrantyConfirm;
            $warranty->warranty_id = $warranty_id;
            $warranty->status = $status;
            $warranty->save();
        return redirect()->action('Backend\SellerController@dataWarranty');
    }

    public function rules_updateProductPrice() {
        return [
            'price' => 'required',
        ];
    }

    public function messages_updateProductPrice() {
        return [
            'price.required' => 'กรุณากรอกราคาสินค้าปัจจุบัน',
        ];
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
}
