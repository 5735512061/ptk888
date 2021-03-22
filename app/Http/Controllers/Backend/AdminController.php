<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\ImageWebsite;
use App\model\Category;
use App\model\FilmType;
use App\model\Brand;
use App\model\Product;
use App\model\ImageProduct;
use App\model\Promotion;
use App\model\MessageCustomer;
use App\model\PhoneModel;
use App\model\StockFilm;
use App\model\ProductFilmInformation;
use App\model\ProductPrice;
use App\model\Serialnumber;
use App\model\ProductOut;

use App\Member;
use App\Store;
use App\Seller;

use Validator;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /////////////////////////////// จัดการข้อมูลลูกค้า ///////////////////////////////
    public function dataOfCustomer(Request $request){
        $NUM_PAGE = 10;
        $customers = Member::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageCustomer/data-of-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('customers',$customers);
    }

    public function deleteMemberCustomer($id){
        $customer = Member::findOrFail($id);
        $customer->delete();
        return back();
    }

    public function editMemberCustomer($id){
        $member = Member::findOrFail($id);
        return view('backend/admin/manageCustomer/edit-member-customer')->with('member',$member);
    }

    public function updateMemberCustomer(Request $request){
        $id = $request->get('id');
        $member = Member::findOrFail($id);
        $member->update($request->all());
        return redirect()->action('Backend\\AdminController@dataOfCustomer');
    }

    /////////////////////////////// จัดการข้อมูลสมาชิกร้านค้า ///////////////////////////////
    public function deleteMemberStore($id){
        $store = Store::findOrFail($id);
        $store->delete();
        return back();
    }

    public function editMemberStore(Request $request, $id){
        $NUM_PAGE = 10;
        $store = Store::findOrFail($id);
        $members = Store::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageStore/edit-member-store')->with('NUM_PAGE',$NUM_PAGE)
                                                                  ->with('page',$page)
                                                                  ->with('store',$store)
                                                                  ->with('members',$members);
    }

    public function updateMemberStore(Request $request){
        $id = $request->get('id');
        $store = Store::findOrFail($id);
        $store->update($request->all());
        return redirect()->action('AuthStore\RegisterController@manageMemberStore');
    }

    /////////////////////////////// จัดการข้อมูลพนักงานขาย ///////////////////////////////
    public function deleteSeller($id){
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return back();
    }

    public function editSeller(Request $request, $id){
        $NUM_PAGE = 10;
        $seller = Seller::findOrFail($id);
        $sellers = Seller::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageSeller/edit-seller')->with('NUM_PAGE',$NUM_PAGE)
                                                             ->with('page',$page)
                                                             ->with('seller',$seller)
                                                             ->with('sellers',$sellers);
    }

    public function updateSeller(Request $request){
        $id = $request->get('id');
        $seller = Seller::findOrFail($id);
        $seller->update($request->all());
        return redirect()->action('AuthSeller\RegisterController@manageSeller');
    }

    /////////////////////////////// จัดการรูปภาพหน้าเว็บไซต์ โปรโมชั่น จัดการข้อมูลรูปภาพ และจัดการข้อมูลคุณสมบัติของสินค้า ///////////////////////////////
    public function manageImageWebsite(Request $request){
        $NUM_PAGE = 10;
        $images = ImageWebsite::orderByRaw('FIELD(image_type,"รูปภาพโลโก้","รูปภาพสไลด์หลัก หน้าแรก")')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageImageWebsite/manage-image-website')->with('NUM_PAGE',$NUM_PAGE)
                                                                            ->with('page',$page)
                                                                            ->with('images',$images);
    }

    public function uploadImageWebsite(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadImageWebsite(), $this->messages_uploadImageWebsite());
        if($validator->passes()) {
            $imageUpload = $request->all();
            $imageUpload = ImageWebsite::create($imageUpload);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_website/', $filename);
                $path = 'image_upload/image_website/'.$filename;
                $imageUpload->image = $filename;
                $imageUpload->save();
            }
            $request->session()->flash('alert-success', 'อัพโหลดรูปภาพสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดรูปภาพไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteImageWebsite($id){
        $image_website = ImageWebsite::findOrFail($id);
        $image_website->delete();
        return back();
    }

    public function editImageWebsite(Request $request, $id){
        $NUM_PAGE = 10;
        $image_website = ImageWebsite::findOrFail($id);
        $images = ImageWebsite::orderByRaw('FIELD(image_type,"รูปภาพโลโก้","รูปภาพสไลด์หลัก หน้าแรก")')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageImageWebsite/edit-image-website')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('image_website',$image_website)
                                                                          ->with('images',$images);
    }

    public function updateImageWebsite(Request $request){
        $id = $request->get('id');
        $image_website = ImageWebsite::findOrFail($id);
        $image_website->update($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('image_upload/image_website/', $filename);
            $path = 'image_upload/image_website/'.$filename;
            $image_website = ImageWebsite::findOrFail($id);
            $image_website->image = $filename;
            $image_website->save();
        }
        return redirect()->action('Backend\AdminController@manageImageWebsite');
    }

    public function managePromotion(Request $request){
        $NUM_PAGE = 10;
        $promotions = Promotion::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageImageWebsite/manage-promotion')->with('NUM_PAGE',$NUM_PAGE)
                                                                        ->with('page',$page)
                                                                        ->with('promotions',$promotions);
    }

    public function uploadPromotion(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadPromotion(), $this->messages_uploadPromotion());
        if($validator->passes()) {
            $promotion = $request->all();
            $promotion = Promotion::create($promotion);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_promotion/', $filename);
                $path = 'image_upload/image_promotion/'.$filename;
                $promotion->image = $filename;
                $promotion->save();
            }
            $request->session()->flash('alert-success', 'อัพโหลดโปรโมชั่นสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดโปรโมชั่นไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function manageFilmInformation(Request $request){
        $NUM_PAGE = 10;
        $product_film_informations = ProductFilmInformation::paginate($NUM_PAGE);
        $film_types = FilmType::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProductFilmInformation/manage-film-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                                         ->with('page',$page)
                                                                                         ->with('product_film_informations',$product_film_informations)
                                                                                         ->with('film_types',$film_types);
    }

    public function uploadFilmInformation(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadFilmInformation(), $this->messages_uploadFilmInformation());
        if($validator->passes()) {
            $product_film_information = $request->all();
            $product_film_information = ProductFilmInformation::create($product_film_information);

            $request->session()->flash('alert-success', 'อัพโหลดข้อมูลและคุณสมบัติสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดข้อมูลและคุณสมบัติไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteFilmInformation($id){
        $product_film_information = ProductFilmInformation::findOrFail($id);
        $product_film_information->delete();
        return back();
    }

    public function editFilmInformation(Request $request, $id){
        $NUM_PAGE = 10;
        $product_film_information = ProductFilmInformation::findOrFail($id);
        $product_film_informations = ProductFilmInformation::paginate($NUM_PAGE);
        $film_types = FilmType::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProductFilmInformation/edit-film-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                                       ->with('page',$page)
                                                                                       ->with('product_film_information',$product_film_information)
                                                                                       ->with('product_film_informations',$product_film_informations)
                                                                                       ->with('film_types',$film_types);
    }

    public function updateFilmInformation(Request $request){
        $id = $request->get('id');
        $product_film_information = ProductFilmInformation::findOrFail($id);
        $product_film_information->update($request->all());
        return redirect()->action('Backend\AdminController@manageFilmInformation');
    }

    /////////////////////////////// จัดการประเภทผลิตภัณฑ์ และประเภทฟิล์ม /////////////////////////////// 
    public function manageCategory(Request $request){
        $NUM_PAGE = 10;
        $categorys = Category::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageCategory/manage-category')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('categorys',$categorys);
    }

    public function uploadCategory(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadCategory(), $this->messages_uploadCategory());
        if($validator->passes()) {
            $category = $request->all();
            $category = Category::create($category);

            $request->session()->flash('alert-success', 'อัพโหลดประเภทผลิตภัณฑ์สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดประเภทผลิตภัณฑ์ไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteCategory($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return back();
    }

    public function editCategory(Request $request, $id){
        $NUM_PAGE = 10;
        $category = Category::findOrFail($id);
        $categorys = Category::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageCategory/edit-category')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('category',$category)
                                                                 ->with('categorys',$categorys);
    }

    public function updateCategory(Request $request){
        $id = $request->get('id');
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->action('Backend\AdminController@manageCategory');
    }

    public function manageFilmType(Request $request){
        $NUM_PAGE = 10;
        $film_types = FilmType::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageFilmType/manage-film-type')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('film_types',$film_types);
    }

    public function uploadFilmType(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadFilmType(), $this->messages_uploadFilmType());
        if($validator->passes()) {
            $film_type = $request->all();
            $film_type = FilmType::create($film_type);

                $film_type = $request->get('film_type');
                $stock_film_type = new StockFilm;
                $stock_film_type->film_type = $film_type;
                $stock_film_type->amount = 0;
                $stock_film_type->comment = null;
                $stock_film_type->save();

            $request->session()->flash('alert-success', 'อัพโหลดประเภทฟิล์มสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดประเภทฟิล์มไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteFilmType($id){
        $film_type = FilmType::findOrFail($id);
        $film_type->delete();
        return back();
    }

    public function editFilmType(Request $request, $id){
        $NUM_PAGE = 10;
        $film_type = FilmType::findOrFail($id);
        $film_types = FilmType::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageFilmType/edit-film-type')->with('NUM_PAGE',$NUM_PAGE)
                                                                  ->with('page',$page)
                                                                  ->with('film_type',$film_type)
                                                                  ->with('film_types',$film_types);
    }

    public function updateFilmType(Request $request){
        $id = $request->get('id');
        $film_type = FilmType::findOrFail($id);
        $film_type->update($request->all());
        return redirect()->action('Backend\AdminController@manageFilmType');
    }

    /////////////////////////////// จัดการยี่ห้อโทรศัพท์ และรุ่นโทรศัพท์ ///////////////////////////////
    public function manageBrand(Request $request){
        $NUM_PAGE = 10;
        $brands = Brand::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageBrand/manage-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                             ->with('page',$page)
                                                             ->with('brands',$brands);
    }

    public function uploadBrand(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadBrand(), $this->messages_uploadBrand());
        if($validator->passes()) {
            $imageUpload = $request->all();
            $imageUpload = Brand::create($imageUpload);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_brand/', $filename);
                $path = 'image_upload/image_brand/'.$filename;
                $imageUpload->image = $filename;
                $imageUpload->save();
            }
            $request->session()->flash('alert-success', 'อัพโหลดยี่ห้อโทรศัพท์สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดยี่ห้อโทรศัพท์ไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteBrand($id){
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return back();
    }

    public function editBrand(Request $request, $id){
        $NUM_PAGE = 10;
        $brand = Brand::findOrFail($id);
        $brands = Brand::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageBrand/edit-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page)
                                                           ->with('brand',$brand)
                                                           ->with('brands',$brands);
    }

    public function updateBrand(Request $request){
        $id = $request->get('id');
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('image_upload/image_brand/', $filename);
            $path = 'image_upload/image_brand/'.$filename;
            $brand = Brand::findOrFail($id);
            $brand->image = $filename;
            $brand->save();
        }
        return redirect()->action('Backend\AdminController@manageBrand');
    }

    public function managePhoneModel(Request $request){
        $NUM_PAGE = 10;
        $phoneModels = PhoneModel::paginate($NUM_PAGE);
        $brands = Brand::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/managePhoneModel/manage-phone-model')->with('NUM_PAGE',$NUM_PAGE)
                                                                        ->with('page',$page)
                                                                        ->with('phoneModels',$phoneModels)
                                                                        ->with('brands',$brands);
    }

    public function uploadPhoneModel(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadPhoneModel(), $this->messages_uploadPhoneModel());
        if($validator->passes()) {
            $phoneModel = $request->all();
            $phoneModel = PhoneModel::create($phoneModel);
            $request->session()->flash('alert-success', 'อัพโหลดรุ่นโทรศัพท์สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดรุ่นโทรศัพท์ไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deletePhoneModel($id){
        $phoneModel = PhoneModel::findOrFail($id);
        $phoneModel->delete();
        return back();
    }

    public function editPhoneModel(Request $request, $id){
        $NUM_PAGE = 10;
        $phoneModel = PhoneModel::findOrFail($id);
        $phoneModels = PhoneModel::paginate($NUM_PAGE);
        $brands = Brand::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/managePhoneModel/edit-phone-model')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('phoneModel',$phoneModel)
                                                                      ->with('phoneModels',$phoneModels)
                                                                      ->with('brands',$brands);
    }

    public function updatePhoneModel(Request $request){
        $id = $request->get('id');
        $phoneModel = PhoneModel::findOrFail($id);
        $phoneModel->update($request->all());
        return redirect()->action('Backend\AdminController@managePhoneModel');
    }

    /////////////////////////////// จัดการคลังสินค้า ///////////////////////////////
    public function uploadProductForm(Request $request){
        $NUM_PAGE = 10;
        $products = Product::paginate($NUM_PAGE);
        $categorys = Category::get();
        $brands = Brand::get();
        $phone_models = PhoneModel::get();
        $film_types = FilmType::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProduct/upload-product-form')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('products',$products)
                                                                      ->with('categorys',$categorys)
                                                                      ->with('brands',$brands)
                                                                      ->with('phone_models',$phone_models)
                                                                      ->with('film_types',$film_types);
    }

    public function uploadProduct(Request $request){
        $validator = Validator::make($request->all(), $this->rules_uploadProduct(), $this->messages_uploadProduct());
        if($validator->passes()) {
            $product = $request->all();
            $product = Product::create($product);
            $product_id = Product::orderBy('id','desc')->value('id');
            $image=array();
            if($files=$request->file('image')){
                foreach($files as $file){
                    $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                    $file->move('image_upload/image_product/', $filename);
                    $path = 'image_upload/image_product/'.$filename;
                    $image[]=$filename;
                }
            }

            for ($i=0; $i < count($image) ; $i++) { 
                $imageUpload = new ImageProduct;
                $imageUpload->product_id = $product_id;
                $imageUpload->image = $image[$i];
                $imageUpload->save();
            }
            $request->session()->flash('alert-success', 'อัพโหลดสินค้าสำเร็จ');
            return redirect()->action('Backend\\AdminController@uploadProductForm');
        }
        else {
            $request->session()->flash('alert-danger', 'อัพโหลดสินค้าไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function listProduct(Request $request){
        $NUM_PAGE = 20;
        $products = Product::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProduct/list-product')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('products',$products);
    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);

        $images =  ImageProduct::where('product_id',$product->id)->get();
            foreach($images as $image => $value) {
                $image_product = ImageProduct::where('product_id',$value->product_id)->delete();
            }

        $product->delete();
        return back();
    }

    public function editProduct(Request $request, $id){
        $product = Product::findOrFail($id);
        $categorys = Category::get();
        $brands = Brand::get();
        $phone_models = PhoneModel::get();
        $film_types = FilmType::get();
        return view('backend/admin/manageProduct/edit-product')->with('product',$product)
                                                               ->with('categorys',$categorys)
                                                               ->with('brands',$brands)
                                                               ->with('phone_models',$phone_models)
                                                               ->with('film_types',$film_types);
    }

    public function updateProduct(Request $request){
        $id = $request->get('id');
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->action('Backend\AdminController@listProduct');
    }

    public function listProductPrice(Request $request){
        $NUM_PAGE = 20;
        $products = Product::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProductPrice/list-product-price')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('products',$products);
    }

    public function editProductPrice($id){
        $product = Product::findOrFail($id);
        return view('backend/admin/manageProductPrice/edit-product-price')->with('product',$product);
    }

    public function updateProductPrice(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateProductPrice(), $this->messages_updateProductPrice());
        if($validator->passes()) {
            $price = $request->all();
            $price = ProductPrice::create($price);
            $request->session()->flash('alert-success', 'อัพโหลดราคาสำเร็จ');
            return redirect()->action('Backend\AdminController@listProductPrice');
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
        return view('backend/admin/manageProductPrice/product-price-detail')->with('NUM_PAGE',$NUM_PAGE)
                                                                            ->with('page',$page)
                                                                            ->with('product_prices',$product_prices)
                                                                            ->with('product',$product);
    }

    public function deleteProductPriceDetail($id){
        $price = ProductPrice::findOrFail($id);
        $price->delete();
        return back();
    }

    /////////////////////////////// การสอบถามของลูกค้า ///////////////////////////////
    public function MessageCustomer(Request $request){
        $NUM_PAGE = 10;
        $messages = MessageCustomer::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/message/message-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                             ->with('page',$page)
                                                             ->with('messages',$messages);
    }

    /////////////////////////////// จัดการสต๊อกสินค้า ///////////////////////////////
    public function manageFilmStock(Request $request){
        $NUM_PAGE = 20;
        $stock_films = StockFilm::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageStock/film-stock')->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page)
                                                           ->with('stock_films',$stock_films);
    }

    /////////////////////////////// สร้าง serialnumber บาร์โค้ด ///////////////////////////////
    public function serialnumber(Request $request){
        $NUM_PAGE = 20;
        $serialnumbers = Serialnumber::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageSerialnumber/list-serialnumber')->with('NUM_PAGE',$NUM_PAGE)
                                                                         ->with('page',$page)
                                                                         ->with('serialnumbers',$serialnumbers);
    }

    public function serialnumberPost(Request $request){
        $serialnumber = $request->all();
        $serialnumber = Serialnumber::create($serialnumber);
        return back();
    }

    public function deleteSerialnumber($id){
        $serialnumber = Serialnumber::findOrFail($id);
        $serialnumber->delete();
        return back();
    }

    public function editSerialnumber(Request $request, $id){
        $NUM_PAGE = 20;
        $serialnumber = Serialnumber::findOrFail($id);
        $serialnumbers = Serialnumber::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageSerialnumber/edit-serialnumber')->with('NUM_PAGE',$NUM_PAGE)
                                                                         ->with('page',$page)
                                                                         ->with('serialnumber',$serialnumber)
                                                                         ->with('serialnumbers',$serialnumbers);
    }                                                           

    public function updateSerialnumber(Request $request){
        $id = $request->get('id');
        $serialnumber = Serialnumber::findOrFail($id);
        $serialnumber->update($request->all());
        return redirect()->action('Backend\AdminController@serialnumber');
    }

    /////////////////////////////// จัดการออเดอร์ การสั่งซื้อ รายการสินค้าออก ///////////////////////////////
    public function productOut(Request $request){
        $NUM_PAGE = 20;
        $product_outs = ProductOut::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageOrderProduct/product-out')->with('NUM_PAGE',$NUM_PAGE)
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

    /////////////////////////////// validate ///////////////////////////////
    public function rules_uploadImageWebsite() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_uploadImageWebsite() {
        return [
            'image.required' => 'กรุณาเลือกไฟล์รูปภาพ 1 รูป',
        ];
    }

    public function rules_uploadPromotion() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_uploadPromotion() {
        return [
            'image.required' => 'กรุณาเลือกไฟล์รูปภาพ 1 รูป',
        ];
    }

    public function rules_uploadFilmInformation() {
        return [
            'film_information' => 'required',
        ];
    }

    public function messages_uploadFilmInformation() {
        return [
            'film_information.required' => 'กรุณากรอกรายละเอียด',
        ];
    }

    public function rules_uploadCategory() {
        return [
            'category' => 'required',
            'category_eng' => 'required',
        ];
    }

    public function messages_uploadCategory() {
        return [
            'category.required' => 'กรุณากรอกประเภทผลิตภัณฑ์',
            'category_eng.required' => 'กรุณากรอกประเภทผลิตภัณฑ์ (ภาษาอังกฤษ)',
        ];
    }

    public function rules_uploadFilmType() {
        return [
            'film_type' => 'required',
            'film_type_eng' => 'required',
        ];
    }

    public function messages_uploadFilmType() {
        return [
            'film_type.required' => 'กรุณากรอกประเภทฟิล์ม',
            'film_type_eng.required' => 'กรุณากรอกประเภทฟิล์ม (ภาษาอังกฤษ)',
        ];
    }

    public function rules_uploadBrand() {
        return [
            'brand' => 'required',
            'brand_eng' => 'required',
            'image' => 'required',
        ];
    }

    public function messages_uploadBrand() {
        return [
            'brand.required' => 'กรุณากรอกยี่ห้อโทรศัพท์',
            'brand_eng.required' => 'กรุณากรอกยี่ห้อโทรศัพท์ (ภาษาอังกฤษ)',
            'image.required' => 'กรุณาเลือกไฟล์รูปภาพ 1 รูป',
        ];
    }

    public function rules_uploadPhoneModel() {
        return [
            'model' => 'required',
            'model_eng' => 'required',
        ];
    }

    public function messages_uploadPhoneModel() {
        return [
            'model.required' => 'กรุณากรอกรุ่นโทรศัพท์',
            'model_eng.required' => 'กรุณากรอกรุ่นโทรศัพท์ (ภาษาอังกฤษ)',
        ];
    }

    public function rules_uploadProduct() {
        return [
            'phone_model_id' => 'required',
            'product_name' => 'required',
            'image' => 'required',
        ];
    }

    public function messages_uploadProduct() {
        return [
            'phone_model_id.required' => 'กรุณากรอกรุ่นโทรศัพท์',
            'product_name.required' => 'กรุณากรอกชื่อสินค้า',
            'image.required' => 'กรุณาเลือกไฟล์รูปภาพ 1 รูป',
        ];
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
