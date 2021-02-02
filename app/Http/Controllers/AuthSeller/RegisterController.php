<?php

namespace App\Http\Controllers\AuthSeller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Seller;

class RegisterController extends Controller
{
    public function ShowRegisterFormSeller(){
        return view('authSeller/register');
    }

    public function registerSeller(Request $request) {
        $seller = $request->all();
        $seller['password'] = bcrypt($seller['password']);
        $seller = Seller::create($seller);
        return back();
    }
}
