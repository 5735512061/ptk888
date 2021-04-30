<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Product;
use App\model\StockFilm;
use App\model\ProductFilmInformation;
use App\model\ProductPrice;
use App\model\ProductPromotionPrice;
use App\model\Serialnumber;
use App\model\ProductOut;
use App\model\DataWarrantyMember;
use App\model\WarrantyConfirm;
use App\model\OrderCustomer;
use App\model\OrderCustomerConfirm;
use App\model\OrderStore;
use App\model\OrderStoreFilmBrand;
use App\model\OrderStoreConfirm;
use App\model\OrderStoreConfirmFilmBrand;
use App\model\FilmPriceStore;
use App\model\ProductStoreFilmBrand;
use App\model\ProductStoreFilmBrandPrice;
use App\model\FilmType;
use App\model\PaymentCheckoutCustomer;
use App\model\PaymentCheckoutStore;
use App\model\PaymentCheckoutStoreFilmBrand;
use App\model\ShipmentCustomer;
use App\model\ShipmentStore;
use App\model\ShipmentStoreFilmBrand;
use App\model\ProductCartCustomer;
use App\model\ProductCartStore;
use App\model\ProductCartStoreFilmBrand;

use Validator;
use Carbon\Carbon;

class SellerController extends Controller
{
    public function __construct(){
        $this->middleware('auth:seller');
    }

    /////////////////////////////// จัดการคลังสินค้า ///////////////////////////////
    public function listProduct(Request $request){
        $NUM_PAGE = 50;
        $products = Product::orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProduct/list-product')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('products',$products);
    }

    public function listProductPrice(Request $request){
        $NUM_PAGE = 50;
        $products = Product::orderBy('id','asc')->paginate($NUM_PAGE);
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
        $NUM_PAGE = 50;
        $product_prices = ProductPrice::where('product_id',$id)->orderBy('id','asc')->orderBy('id','asc')->paginate($NUM_PAGE);
        $product = Product::where('id',$id)->value('product_name');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/product-price-detail')->with('NUM_PAGE',$NUM_PAGE)
                                                                             ->with('page',$page)
                                                                             ->with('product_prices',$product_prices)
                                                                             ->with('product',$product);
    }

    public function listProductPromotionPrice(Request $request){
        $NUM_PAGE = 50;
        $products = Product::orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/list-product-promotion-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                                     ->with('page',$page)
                                                                                     ->with('products',$products);
    }

    public function editProductPromotionPrice($id){
        $product = Product::findOrFail($id);
        return view('backend/seller/manageProductPrice/edit-product-promotion-price')->with('product',$product);
    }

    public function updateProductPromotionPrice(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateProductPromotionPrice(), $this->messages_updateProductPromotionPrice());
        if($validator->passes()) {
            $price = $request->all();
            $price = ProductPromotionPrice::create($price);
            $request->session()->flash('alert-success', 'อัพโหลดโปรโมชั่นสำเร็จ');
            return redirect()->action('Backend\SellerController@listProductPromotionPrice');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดโปรโมชั่นไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function ProductPromotionPriceDetail(Request $request,$id){
        $NUM_PAGE = 50;
        $product_prices = ProductPromotionPrice::where('product_id',$id)->orderBy('id','asc')->paginate($NUM_PAGE);
        $product = Product::where('id',$id)->value('product_name');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/product-promotion-price-detail')->with('NUM_PAGE',$NUM_PAGE)
                                                                                       ->with('page',$page)
                                                                                       ->with('product_prices',$product_prices)
                                                                                       ->with('product',$product);
    }

    /////////////////////////////// จัดการสต๊อกสินค้า ///////////////////////////////
    public function manageFilmStock(Request $request){
        $NUM_PAGE = 50;
        $stock_films = StockFilm::orderBy('id','asc')->paginate($NUM_PAGE);
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
        $NUM_PAGE = 50;
        $product_outs = ProductOut::orderBy('id','asc')->paginate($NUM_PAGE);
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
        $NUM_PAGE = 50;
        $orders = OrderCustomer::groupBy('bill_number')->orderBy('id','asc')->paginate($NUM_PAGE);
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

    public function updateOrderCustomerStatus(Request $request) {
        $status = $request->all();
        $status = OrderCustomerConfirm::create($status);
        return back();
    }

    public function deleteOrderCustomer($id){
        $order_customer = OrderCustomer::findOrFail($id);
        $products = OrderCustomer::where('bill_number',$order_customer->bill_number)->get();

            foreach($products as $product => $value) {
                $order_confirm = OrderCustomerConfirm::where('order_id',$value->id)->delete();
                $product = OrderCustomer::where('bill_number',$value->bill_number)->delete();
                $payment = PaymentCheckoutCustomer::where('bill_number',$value->bill_number)->delete();
                $shipment = ShipmentCustomer::where('bill_number',$value->bill_number)->delete();
                $product_cart = ProductCartCustomer::where('bill_number',$value->bill_number)->delete();
                $order_customer = OrderCustomer::where('bill_number',$value->bill_number)->delete();
            }

            return redirect()->action('Backend\SellerController@orderCustomer');
    }

    public function orderStore(Request $request){
        $NUM_PAGE = 50;
        $orders = OrderStore::groupBy('bill_number')->orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/order-store')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('orders',$orders);
    }

    public function orderStoreDetail($id){
        $order = OrderStore::findOrFail($id);
        return view('backend/seller/manageOrderProduct/order-store-detail')->with('order',$order);
    }

    public function updateOrderStoreStatus(Request $request) {
        $status = $request->all();
        $status = OrderStoreConfirm::create($status);
        return back();
    }

    public function deleteOrderStore($id){
        $order_store = OrderStore::findOrFail($id);
        $products = OrderStore::where('bill_number',$order_store->bill_number)->get();

            foreach($products as $product => $value) {
                $order_confirm = OrderStoreConfirm::where('order_id',$value->id)->delete();
                $product = OrderStore::where('bill_number',$value->bill_number)->delete();
                $payment = PaymentCheckoutStore::where('bill_number',$value->bill_number)->delete();
                $shipment = ShipmentStore::where('bill_number',$value->bill_number)->delete();
                $product_cart = ProductCartStore::where('bill_number',$value->bill_number)->delete();
                $order_store = OrderStore::where('bill_number',$value->bill_number)->delete();
            }

            return redirect()->action('Backend\SellerController@orderStore');
    }

    public function orderStoreFilmBrand(Request $request){
        $NUM_PAGE = 50;
        $orders = OrderStoreFilmBrand::groupBy('bill_number')->orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/order-store-film-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                                              ->with('page',$page)
                                                                              ->with('orders',$orders);
    }

    public function orderStoreDetailFilmBrand($id){
        $order = OrderStoreFilmBrand::findOrFail($id);
        return view('backend/seller/manageOrderProduct/order-store-detail-film-brand')->with('order',$order);
    }

    public function updateOrderStoreStatusFilmBrand(Request $request) {
        $status = $request->all();
        $status = OrderStoreConfirmFilmBrand::create($status);
        return back();
    }

    public function deleteOrderStoreFilmBrand($id){
        $order_store = OrderStoreFilmBrand::findOrFail($id);
        
        $products = OrderStoreFilmBrand::where('bill_number',$order_store->bill_number)->get();

            foreach($products as $product => $value) {
                $order_confirm = OrderStoreConfirmFilmBrand::where('order_id',$value->id)->delete();
                $product = OrderStoreFilmBrand::where('bill_number',$value->bill_number)->delete();
                $payment = PaymentCheckoutStoreFilmBrand::where('bill_number',$value->bill_number)->delete();
                $shipment = ShipmentStoreFilmBrand::where('bill_number',$value->bill_number)->delete();
                $product_cart = ProductCartStoreFilmBrand::where('bill_number',$value->bill_number)->delete();
                $order_store = OrderStoreFilmBrand::where('bill_number',$value->bill_number)->delete();
            }

            return redirect()->action('Backend\SellerController@orderStoreFilmBrand');
    }

    /////////////////////////////// ข้อมูลการลงทะเบียน และข้อมูลการเคลมสินค้า ///////////////////////////////
    public function dataWarranty(Request $request){
        $NUM_PAGE = 50;
        $data_warrantys = DataWarrantyMember::orderBy('id','asc')->paginate($NUM_PAGE);
        $date_now = Carbon::now()->format('Y-m-d');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/data-warranty-member')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('data_warrantys',$data_warrantys)
                                                                       ->with('date_now',$date_now);
    }

    public function deleteDataWarranty($id){
        $warranty_confirm = WarrantyConfirm::where('warranty_id',$id)->delete();
        $data_warranty = DataWarrantyMember::findOrFail($id);
        $data_warranty->delete();
        return redirect()->action('Backend\SellerController@dataWarranty');
    }

    public function editDataWarranty(Request $request, $id){
        $NUM_PAGE = 50;
        $data_warranty = DataWarrantyMember::findOrFail($id);
        $data_warrantys = DataWarrantyMember::orderBy('id','asc')->paginate($NUM_PAGE);
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

    public function claimProduct(Request $request){
        $NUM_PAGE = 50;
        $claim_products = WarrantyConfirm::orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/claim-product')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('claim_products',$claim_products);
    }

    public function editClaimStatus(Request $request, $id){
        $NUM_PAGE = 50;
        $claim_products = WarrantyConfirm::orderBy('id','asc')->paginate($NUM_PAGE);
        $claim_status = WarrantyConfirm::findOrFail($id);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/edit-claim-status')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('claim_products',$claim_products)
                                                                    ->with('claim_status',$claim_status);
    }

    // จัดการราคาของร้านค้า
    public function listProductPriceStore(Request $request){
        $NUM_PAGE = 50;
        $stock_films = StockFilm::orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPriceStore/list-product-price-store')->with('NUM_PAGE',$NUM_PAGE)
                                                                                     ->with('page',$page)
                                                                                     ->with('stock_films',$stock_films);
    }

    public function editProductPriceStore($id){
        $stock_film = StockFilm::findOrFail($id);
        return view('backend/seller/manageProductPriceStore/edit-product-price-store')->with('stock_film',$stock_film);
    }

    public function updateProductPriceStore(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateProductPriceStore(), $this->messages_updateProductPriceStore());
        if($validator->passes()) {

            $date = Carbon::now()->format('Y-m-d');
            $film_id = $request->get('film_id');
            $price = $request->get('price');

            $film_price_store = new FilmPriceStore;
            $film_price_store->film_id = $film_id;
            $film_price_store->date = $date;
            $film_price_store->price = $price;
            $film_price_store->save();
            
            $request->session()->flash('alert-success', 'อัพโหลดราคาสำเร็จ');
            return redirect()->action('Backend\SellerController@listProductPriceStore');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดราคาไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function ProductPriceDetailStore(Request $request,$id){
        $NUM_PAGE = 50;
        $film_price_stores = FilmPriceStore::where('film_id',$id)->orderBy('id','asc')->paginate($NUM_PAGE);
        $film_type = StockFilm::where('id',$id)->value('film_type');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPriceStore/product-price-detail-store')->with('NUM_PAGE',$NUM_PAGE)
                                                                                       ->with('page',$page)
                                                                                       ->with('film_price_stores',$film_price_stores)
                                                                                       ->with('film_type',$film_type);
    }

    public function listProductPriceStoreFilmBrand(Request $request){
        $NUM_PAGE = 50;
        $product_store_film_brands = ProductStoreFilmBrand::orderBy('id','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPriceStore/list-product-price-store-film-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                                                                ->with('page',$page)
                                                                                                ->with('product_store_film_brands',$product_store_film_brands);
    }

    public function editProductPriceStoreFilmBrand($id){
        $product_store_film_brand = ProductStoreFilmBrand::findOrFail($id);
        return view('backend/seller/manageProductPriceStore/edit-product-price-store-film-brand')->with('product_store_film_brand',$product_store_film_brand);
    }

    public function updateProductPriceStoreFilmBrand(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateProductPriceStoreFilmBrand(), $this->messages_updateProductPriceStoreFilmBrand());
        if($validator->passes()) {

            $product_id = $request->get('product_id');
            $price = $request->get('price');

            $product_store_film_brand_price = new ProductStoreFilmBrandPrice;
            $product_store_film_brand_price->product_id = $product_id;
            $product_store_film_brand_price->price = $price;
            $product_store_film_brand_price->save();
            
            $request->session()->flash('alert-success', 'อัพโหลดราคาสำเร็จ');
            return redirect()->action('Backend\SellerController@listProductPriceStoreFilmBrand');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดราคาไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function ProductPriceDetailStoreFilmBrand(Request $request,$id){
        $NUM_PAGE = 50;
        $product_store_film_brand_prices = ProductStoreFilmBrandPrice::where('product_id',$id)->orderBy('id','asc')->paginate($NUM_PAGE);
        $film_brand = ProductStoreFilmBrand::where('id',$id)->value('film_brand');
        $film_type_id = ProductStoreFilmBrand::where('id',$id)->value('film_type_id');
        $film_type = FilmType::where('id',$film_type_id)->value('film_type');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPriceStore/product-price-detail-store-film-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                                                                  ->with('page',$page)
                                                                                                  ->with('product_store_film_brand_prices',$product_store_film_brand_prices)
                                                                                                  ->with('film_brand',$film_brand)
                                                                                                  ->with('film_type',$film_type);
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

    public function rules_updateProductPromotionPrice() {
        return [
            'promotion_price' => 'required',
        ];
    }

    public function messages_updateProductPromotionPrice() {
        return [
            'promotion_price.required' => 'กรุณากรอกราคาโปรโมชั่น',
        ];
    }

    public function rules_updateProductPriceStore() {
        return [
            'price' => 'required',
        ];
    }

    public function messages_updateProductPriceStore() {
        return [
            'price.required' => 'กรุณากรอกราคาสินค้าปัจจุบัน',
        ];
    }

    public function rules_updateProductPriceStoreFilmBrand() {
        return [
            'price' => 'required',
        ];
    }

    public function messages_updateProductPriceStoreFilmBrand() {
        return [
            'price.required' => 'กรุณากรอกราคาสินค้าปัจจุบัน',
        ];
    }
}
