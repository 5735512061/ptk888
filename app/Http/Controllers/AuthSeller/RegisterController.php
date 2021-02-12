<?php

namespace App\Http\Controllers\AuthSeller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Seller;

class RegisterController extends Controller
{
    public function manageSeller(Request $request){
        $NUM_PAGE = 10;
        $sellers = Seller::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('authSeller/register')->with('NUM_PAGE',$NUM_PAGE)
                                          ->with('page',$page)
                                          ->with('sellers',$sellers);
    }

    public function registerSeller(Request $request) {
        $seller = $request->all();
        $seller['password'] = bcrypt($seller['password']);
        $seller = Seller::create($seller);
        return back();
    }
}
