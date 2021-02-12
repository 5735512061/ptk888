<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ImageWebsite;
use App\model\Category;
use App\model\Brand;
use App\Member;

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
        return view('backend/admin/index')->with('NUM_PAGE',$NUM_PAGE)
                                          ->with('page',$page)
                                          ->with('customers',$customers);
    }

    public function manageImageWebsite(Request $request){
        $NUM_PAGE = 10;
        $images = ImageWebsite::orderByRaw('FIELD(image_type,"logo","slide_main")')->paginate($NUM_PAGE);
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
}
