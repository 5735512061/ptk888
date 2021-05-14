<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ImageWebsite;
use App\model\Category;
use App\model\Brand;
use App\model\Promotion;
use App\model\Product;
use App\model\PhoneModel;
use App\model\FilmType;
use App\model\ProductFilmInformation;

use App\Store;
use Session;

class PtkController extends Controller
{
    public function index() {
        $images = ImageWebsite::where('image_type','รูปภาพสไลด์หลัก หน้าแรก')->get();
        $products = Product::where('product_recommend','ใช่')->where('status','แสดงสินค้า')->select('id','brand_id','phone_model_id','product_name_'.\Session::get('locale'))->get();
        return view('frontend/index')->with('images',$images)
                                     ->with('products',$products);
    }

    public function contactUs() {
        return view('frontend/company/contact-us');
    }

    public function aboutUs() {
        return view('frontend/company/about-us');
    }

    public function faq() {
        return view('frontend/help-center/faq');
    }

    public function howtoInstall() {
        return view('frontend/help-center/howto-install');
    }

    public function warrantyInformation() {
        return view('frontend/help-center/warranty-information');
    }

    public function dealerShop() {
        $stores = Store::where('status','ใช้งานได้')->get();
        return view('frontend/company/dealer-shop')->with('stores',$stores);
    }

    public function category($category) {
        $category_th = Category::where('category_en',$category)->value('category_th');
        $productRecommends = Product::where('product_recommend','ใช่')->get();
        return view('frontend/category/category-product')->with('category_th',$category_th)
                                                         ->with('productRecommends',$productRecommends);
    }

    public function allBrand() {
        $brands = Brand::get();
        return view('frontend/brand/all-brand')->with('brands',$brands);
    }

    public function brand($brand) {
        $brand_id = Brand::where('brand',$brand)->value('id');
        $phone_models = PhoneModel::where('brand_id',$brand_id)->where('status',"เปิด")->get();
        return view('frontend/brand/brand-product')->with('phone_models',$phone_models);
    }

    public function promotion() {
        $promotions = Promotion::get();
        return view('frontend/promotion/promotion')->with('promotions',$promotions);
    }

    public function productByPhoneModel($brand,$model) {
        $brand_id = Brand::where('brand',$brand)->value('id');
        $model_id = PhoneModel::where('model',$model)->value('id');
        $products = Product::where('brand_id',$brand_id)
                           ->where('phone_model_id',$model_id)
                           ->where('product_recommend','ไม่ใช่')
                           ->where('status','แสดงสินค้า')->select('id','brand_id','phone_model_id','product_name_'.\Session::get('locale'))->get();
        return view('frontend/product/by-phone-model')->with('products',$products);
    }

    public function productByPhoneModelDetail($brand,$model,$id) {
        $product = Product::findOrFail($id);
        $brand_id = Brand::where('brand',$brand)->value('id');
        $model_id = PhoneModel::where('model',$model)->value('id');
        $products = Product::where('brand_id',$brand_id)
                           ->where('phone_model_id',$model_id)
                           ->where('status','แสดงสินค้า')
                           ->where('id',"!=",$product->id)
                           ->select('id','product_name_'.\Session::get('locale'))->get();
        $film_type_id = FilmType::where('film_type',$product->product_type)->value('id');
        // $propertys = ProductFilmInformation::where('film_type_id',$film_type_id)->where('type_information',"ข้อมูลและคุณสมบัติสินค้า")->get();
        $propertys = ProductFilmInformation::where('film_type_id',$film_type_id)
                                            ->where('type_information',"ข้อมูลและคุณสมบัติสินค้า")
                                            ->select('id','film_information_'.\Session::get('locale'))->get();
        return view('frontend/product/by-phone-model-detail')->with('product',$product)
                                                             ->with('products',$products)
                                                             ->with('propertys',$propertys);
    }
}
