<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ImageWebsite;
use App\model\Category;
use App\model\Brand;

class PtkController extends Controller
{
    public function index() {
        $images = ImageWebsite::get();
        return view('frontend/index')->with('images',$images);
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
        return view('frontend/company/dealer-shop');
    }

    public function category() {
        return view('frontend/category/category-product');
    }

    public function brand() {
        return view('frontend/brand/brand-product');
    }
}
