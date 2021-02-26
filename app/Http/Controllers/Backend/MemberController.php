<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\MessageCustomer;

class MemberController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth:member');
    // }

    public function registerWarranty() {
        return view('backend/customer/register-warranty');
    }

    public function sendMessage(Request $request) {
        $message = $request->all();
        $message = MessageCustomer::create($message);
        return back();
    }
}
