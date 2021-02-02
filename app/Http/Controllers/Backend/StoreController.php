<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth:store');
    }

    public function index() {
        return view('backend/member-store/index');
    }
}
