<?php

namespace App\Http\Controllers\AuthStore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;

class RegisterController extends Controller
{
    public function ShowRegisterFormStore(){
        return view('authStore/register');
    }

    public function registerStore(Request $request) {
        $store = $request->all();
        $store['password'] = bcrypt($store['password']);
        $store = Store::create($store);
        return back();
    }
}
