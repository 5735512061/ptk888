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

use App\Member;
use App\Store;
use App\Seller;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    } 

    public function dataOfCustomer(Request $request){
        $NUM_PAGE = 10;
        $customers = Member::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageCustomer/data-of-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                                    ->with('page',$page)
                                                                    ->with('customers',$customers);
    }

    public function memberCheck(Request $request){
        $NUM_PAGE = 10;
        $customers = Member::where('member_id',NULL)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageCustomer/member-check')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('customers',$customers);
    }

    public function manageMemberCustomer($id){
        $member = Member::findOrFail($id);
        return view('backend/admin/manageCustomer/manage-member-customer')->with('member',$member);
    }

    public function memberCustomerComfirm(Request $request) {
        $id = $request->get('id');
        $customer = Member::findOrFail($id);
        $customer->update($request->all());
        return redirect()->action('Backend\\AdminController@dataOfCustomer');
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
        return back();
    }

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
        $category = $request->all();
        $category = Category::create($category);
        return back();
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
        $film_type = $request->all();
        $film_type = FilmType::create($film_type);

            $film_type = $request->get('film_type');
            $stock_film_type = new StockFilm;
            $stock_film_type->film_type = $film_type;
            $stock_film_type->amount = 0;
            $stock_film_type->comment = null;
            $stock_film_type->save();

        return back();
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
        return back();
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
        $phoneModel = $request->all();
        $phoneModel = PhoneModel::create($phoneModel);
        return back();
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

        return redirect()->action('Backend\\AdminController@uploadProductForm');
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
        return back();
    }
    
    public function MessageCustomer(Request $request){
        $NUM_PAGE = 10;
        $messages = MessageCustomer::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/message/message-customer')->with('NUM_PAGE',$NUM_PAGE)
                                                             ->with('page',$page)
                                                             ->with('messages',$messages);
    }

    public function manageFilmStock(Request $request){
        $NUM_PAGE = 20;
        $stock_films = StockFilm::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageStock/film-stock')->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page)
                                                           ->with('stock_films',$stock_films);
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
        $product_film_information = $request->all();
        $product_film_information = ProductFilmInformation::create($product_film_information);
        return back();
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
        $price = $request->all();
        $price = ProductPrice::create($price);
        return redirect()->action('Backend\AdminController@listProductPrice');
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
}
