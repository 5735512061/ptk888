<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\MessageCustomer;
use App\model\DataWarrantyMember;
use App\model\Serialnumber;

class MemberController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth:member');
    // }

    public function registerWarranty() {
        return view('backend/customer/register-warranty');
    }

    public function registerWarrantyPost(Request $request) {
        $warranty = $request->all();
        $serialnumber = $request->get('serialnumber');
        $serialnumber_product = Serialnumber::where('serialnumber',$serialnumber)
                                            ->where('status','ใช้งานแล้ว')->get();
            if(count($serialnumber_product) != 0) {
                $warranty = DataWarrantyMember::create($warranty);
                return back();
            }
            return back();
    }

    public function sendMessage(Request $request) {
        $message = $request->all();
        $message = MessageCustomer::create($message);
        return back();
    }
}
