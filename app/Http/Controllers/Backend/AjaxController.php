<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Response;

use App\model\PhoneModel;

class AjaxController extends Controller
{
    public function ajax_brand(){
        $cat_id = Input::get('cat_id');
        
        $subcategories = PhoneModel::where('brand_id', '=' ,$cat_id)->get();
        return Response::json($subcategories);
    }
}
