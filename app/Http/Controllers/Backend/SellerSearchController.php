<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\DataWarrantyMember;
use App\model\WarrantyConfirm;
use App\model\Product;
use App\model\Serialnumber;
use App\model\ProductOut;
use App\model\OrderCustomer;
use App\model\OrderStore;
use App\model\OrderStoreFilmBrand;

use App\Member;
use App\Store;

use Carbon\Carbon;

class SellerSearchController extends Controller
{
    public function __construct(){
        $this->middleware('auth:seller');
    }

    // ค้นหาข้อมูลการรับประกันสินค้า
    public function searchDataWarranty(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $serialnumber = $request->get('serialnumber');
        $customer_id = Member::where('member_id',$member_id)->value('id');
        $data_warrantys = DataWarrantyMember::where('member_id', $customer_id) 
                                            ->orWhere('serialnumber', $serialnumber) 
                                            ->paginate($NUM_PAGE);
        $date_now = Carbon::now()->format('Y-m-d');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/data-warranty-member')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('data_warrantys',$data_warrantys)
                                                                       ->with('date_now',$date_now);
    }

    // ค้นหาข้อมูลการเคลมสินค้า
    public function searchClaimProduct(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $serialnumber = $request->get('serialnumber');
        $warranty_id = DataWarrantyMember::where('serialnumber',$serialnumber)->value('id');
        $customer_id = Member::where('member_id',$member_id)->value('id');
        $claim_products = WarrantyConfirm::where('member_id', $customer_id) 
                                         ->orWhere('warranty_id', $warranty_id) 
                                         ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/dataWarranty/claim-product')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('claim_products',$claim_products);

    }

    // ค้นหาข้อมูลรายการสินค้า
    public function searchListProduct(Request $request){
        $NUM_PAGE = 50;
        $product_code = $request->get('product_code');
        $product_name = $request->get('product_name');
        $product_type = $request->get('product_type');
        $film_model = $request->get('film_model');
        $products = Product::where('product_code', $product_code) 
                           ->orWhere('product_name', $product_name) 
                           ->orWhere('product_type', $product_type) 
                           ->orWhere('film_model', $film_model) 
                           ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProduct/list-product')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('products',$products);

    }

    // ค้นหาข้อมูลรายการราคาสินค้า
    public function searchListProductPrice(Request $request){
        $NUM_PAGE = 50;
        $product_code = $request->get('product_code');
        $product_name = $request->get('product_name');
        $film_model = $request->get('film_model');
        $products = Product::where('product_code', $product_code) 
                           ->orWhere('product_name', $product_name) 
                           ->orWhere('film_model', $film_model) 
                           ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/list-product-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('products',$products);
    }

    // ค้นหาข้อมูลรายการราคาโปรโมชั่นสินค้า
    public function searchListProductPromotionPrice(Request $request){
        $NUM_PAGE = 50;
        $product_code = $request->get('product_code');
        $product_name = $request->get('product_name');
        $film_model = $request->get('film_model');
        $products = Product::where('product_code', $product_code) 
                           ->orWhere('product_name', $product_name) 
                           ->orWhere('film_model', $film_model) 
                           ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageProductPrice/list-product-promotion-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                                    ->with('page',$page)
                                                                                    ->with('products',$products);
    }

    // ค้นหาหมายเลขสินค้า
    public function searchProductOut(Request $request){
        $NUM_PAGE = 50;
        $serialnumber = $request->get('serialnumber');
        $product_outs = ProductOut::where('serialnumber', $serialnumber) 
                                  ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/product-out')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('product_outs',$product_outs);
    }

    // ค้นหาคำสั่งซื้อของลูกค้า
    public function searchOrderCustomer(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $customer_id = Member::where('member_id',$member_id)->value('id');
        $bill_number = $request->get('bill_number');
        $orders = OrderCustomer::groupBy('bill_number')->orderBy('id','asc')->where('bill_number', $bill_number) 
                               ->orWhere('customer_id', $customer_id) 
                               ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/order-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('orders',$orders);
    }

    // ค้นหาคำสั่งซื้อของร้านค้า
    public function searchOrderStore(Request $request){
        $NUM_PAGE = 50;
        $store_id = $request->get('store_id');
        $store_id = Store::where('store_id',$store_id)->value('id');
        $bill_number = $request->get('bill_number');
        $orders = OrderStore::groupBy('bill_number')->orderBy('id','asc')->where('bill_number', $bill_number) 
                            ->orWhere('store_id', $store_id) 
                            ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/order-store')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('orders',$orders);
    }

    // ค้นหาคำสั่งซื้อพร้อมแพ็คเกจของร้านค้า
    public function searchOrderStoreFilmBrand(Request $request){
        $NUM_PAGE = 50;
        $store_id = $request->get('store_id');
        $store_id = Store::where('store_id',$store_id)->value('id');
        $bill_number = $request->get('bill_number');
        $orders = OrderStoreFilmBrand::groupBy('bill_number')->orderBy('id','asc')->where('bill_number', $bill_number) 
                                     ->orWhere('store_id', $store_id) 
                                     ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/seller/manageOrderProduct/order-store-film-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                                              ->with('page',$page)
                                                                              ->with('orders',$orders);
    }
}
