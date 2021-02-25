<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\ImageWebsite;
use App\model\Category;
use App\model\Brand;
use App\model\Product;
use App\model\ImageProduct;
use App\model\Promotion;

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

    public function uploadProductForm(Request $request){
        $NUM_PAGE = 10;
        $products = Product::paginate($NUM_PAGE);
        $categorys = Category::get();
        $brands = Brand::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/manageProduct/upload-product-form')->with('NUM_PAGE',$NUM_PAGE)
                                                                      ->with('page',$page)
                                                                      ->with('products',$products)
                                                                      ->with('categorys',$categorys)
                                                                      ->with('brands',$brands);
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

        return redirect()->action('Backend\\AdminController@listProduct');
    }

    public function listProduct(Request $request){
        $NUM_PAGE = 10;
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
        return view('backend/admin/manageProduct/edit-product')->with('product',$product)
                                                               ->with('categorys',$categorys)
                                                               ->with('brands',$brands);
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
    
}
