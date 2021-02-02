<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function __construct(){
        $this->middleware('auth:seller');
    }

    public function index() {
        return view('backend/seller/index');
    }
}
