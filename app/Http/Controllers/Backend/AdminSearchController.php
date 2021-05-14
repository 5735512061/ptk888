<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\DataWarrantyMember;
use App\model\WarrantyConfirm;
use App\model\Product;
use App\model\PhoneModel;
use App\model\Brand;
use App\model\Serialnumber;
use App\model\ProductOut;
use App\model\OrderCustomer;
use App\model\OrderStore;
use App\model\OrderStoreFilmBrand;

use App\Member;
use App\Store;
use App\Seller;

use Carbon\Carbon;

class AdminSearchController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    // ค้นหาข้อมูลลูกค้า
    public function searchCustomer(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $phone = $request->get('phone');
        $name = $request->get('name');
        $surname = $request->get('surname');
        $customers = Member::where([
            ['member_id','LIKE', "%{$member_id}"],
            ['phone','LIKE', $phone],
            ['name','LIKE', $name],
            ['surname','LIKE', $surname],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageCustomer/data-of-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('customers',$customers);
    }

    // ค้นหาข้อมูลร้านค้า
    public function searchStore(Request $request){
        $NUM_PAGE = 50;
        $store_id = $request->get('store_id');
        $phone = $request->get('phone');
        $name = $request->get('name');
        $members = Store::where([
            ['store_id','LIKE', "%{$store_id}"],
            ['phone','LIKE', $phone],
            ['name','LIKE', $name],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('authStore/register')->with('NUM_PAGE',$NUM_PAGE)
                                         ->with('page',$page)
                                         ->with('members',$members);
    }

    // ค้นหาข้อมูลพนักงานขาย
    public function searchSeller(Request $request){
        $NUM_PAGE = 50;
        $seller_id = $request->get('seller_id');
        $phone = $request->get('phone');
        $name = $request->get('name');
        $sellers = Seller::where([
            ['seller_id','LIKE', "%{$seller_id}"],
            ['phone','LIKE', $phone],
            ['name','LIKE', $name],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('authSeller/register')->with('NUM_PAGE',$NUM_PAGE)
                                          ->with('page',$page)
                                          ->with('sellers',$sellers);
    }

    // ค้นหาข้อมูลการรับประกันสินค้า
    public function searchDataWarranty(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $serialnumber = $request->get('serialnumber');
        $customer_id = Member::where('member_id','LIKE',"%{$member_id}")->value('id'); 
        $data_warrantys = DataWarrantyMember::where([
            ['member_id', $customer_id],
            ['serialnumber','LIKE', "%{$serialnumber}%"],
        ])->paginate($NUM_PAGE);
        $date_now = Carbon::now()->format('Y-m-d');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/dataWarranty/data-warranty-member')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('data_warrantys',$data_warrantys)
                                                                      ->with('date_now',$date_now);
    }

    // ค้นหาข้อมูลการเคลมสินค้า
    public function searchClaimProduct(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $serialnumber = $request->get('serialnumber');
        $warranty_id = DataWarrantyMember::where('serialnumber','LIKE', "%{$serialnumber}%")->value('id');
        $customer_id = Member::where('member_id','LIKE', "%{$member_id}")->value('id');
        $claim_products = WarrantyConfirm::where([
            ['member_id', $customer_id],
            ['warranty_id', $warranty_id],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/dataWarranty/claim-product')->with('NUM_PAGE',$NUM_PAGE)
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
        $products = Product::where([
            ['product_code','LIKE', "%{$product_code}"],
            ['product_name_th','LIKE', "%{$product_name}%"],
            ['product_type','LIKE', "%{$product_type}%"],
            ['film_model','LIKE', "%{$film_model}%"],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProduct/list-product')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('products',$products);

    }

    // ค้นหาข้อมูลรายการราคาสินค้า
    public function searchListProductPrice(Request $request){
        $NUM_PAGE = 50;
        $product_code = $request->get('product_code');
        $product_name = $request->get('product_name');
        $film_model = $request->get('film_model');
        $products = Product::where([
            ['product_code','LIKE', "%{$product_code}"],
            ['product_name_th','LIKE', "%{$product_name}%"],
            ['film_model','LIKE', "%{$film_model}%"],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProductPrice/list-product-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('products',$products);
    }

    // ค้นหาข้อมูลรายการราคาโปรโมชั่นสินค้า
    public function searchListProductPromotionPrice(Request $request){
        $NUM_PAGE = 50;
        $product_code = $request->get('product_code');
        $product_name = $request->get('product_name');
        $film_model = $request->get('film_model');
        $products = Product::where([
            ['product_code','LIKE', "%{$product_code}"],
            ['product_name_th','LIKE', "%{$product_name}%"],
            ['film_model','LIKE', "%{$film_model}%"],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProductPrice/list-product-promotion-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                                    ->with('page',$page)
                                                                                    ->with('products',$products);
    }

    // ค้นหารุ่นโทรศัพท์
    public function searchPhonemodel(Request $request){
        $NUM_PAGE = 50;
        $model = $request->get('model');
        $phoneModels = PhoneModel::where('model', $model) 
                                 ->paginate($NUM_PAGE);
        $brands = Brand::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/managePhoneModel/manage-phone-model')->with('NUM_PAGE',$NUM_PAGE)
                                                                        ->with('page',$page)
                                                                        ->with('phoneModels',$phoneModels)
                                                                        ->with('brands',$brands);
    }

    // ค้นหาหมายเลขสินค้า
    public function searchSerialnumber(Request $request){
        $NUM_PAGE = 50;
        $serialnumber = $request->get('serialnumber');
        $serialnumbers = Serialnumber::where('serialnumber', $serialnumber) 
                                     ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageSerialnumber/list-serialnumber')->with('NUM_PAGE',$NUM_PAGE)
                                                                         ->with('page',$page)
                                                                         ->with('serialnumbers',$serialnumbers);
    }

    // ค้นหาหมายเลขสินค้า
    public function searchProductOut(Request $request){
        $NUM_PAGE = 50;
        $serialnumber = $request->get('serialnumber');
        $product_outs = ProductOut::where('serialnumber', $serialnumber) 
                                  ->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageOrderProduct/product-out')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('product_outs',$product_outs);
    }

    // ค้นหาคำสั่งซื้อของลูกค้า
    public function searchOrderCustomer(Request $request){
        $NUM_PAGE = 50;
        $member_id = $request->get('member_id');
        $customer_id = Member::where('member_id','LIKE', "%{$member_id}")->value('id');
        $bill_number = $request->get('bill_number');
        $orders = OrderCustomer::groupBy('bill_number')->orderBy('id','asc')->where([
            ['bill_number','LIKE', "%{$bill_number}"],
            ['customer_id', $customer_id],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageOrderProduct/order-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('orders',$orders);
    }

    // ค้นหาคำสั่งซื้อของร้านค้า
    public function searchOrderStore(Request $request){
        $NUM_PAGE = 50;
        $store_id = $request->get('store_id');
        $store_id = Store::where('store_id','LIKE', "%{$store_id}")->value('id');
        $bill_number = $request->get('bill_number');
        $orders = OrderStore::groupBy('bill_number')->orderBy('id','asc')->where([
            ['bill_number','LIKE', "%{$bill_number}"],
            ['store_id', $store_id],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageOrderProduct/order-store')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('orders',$orders);
    }

    // ค้นหาคำสั่งซื้อพร้อมแพ็คเกจของร้านค้า
    public function searchOrderStoreFilmBrand(Request $request){
        $NUM_PAGE = 50;
        $store_id = $request->get('store_id');
        $store_id = Store::where('store_id','LIKE', "%{$store_id}")->value('id');
        $bill_number = $request->get('bill_number');
        $orders = OrderStoreFilmBrand::groupBy('bill_number')->orderBy('id','asc')->where([
            ['bill_number','LIKE', "%{$bill_number}"],
            ['store_id', $store_id],
        ])->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageOrderProduct/order-store-film-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                                              ->with('page',$page)
                                                                              ->with('orders',$orders);
    }

}
