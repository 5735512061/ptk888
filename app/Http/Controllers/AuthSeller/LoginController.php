<?php

namespace App\Http\Controllers\AuthSeller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('authSeller.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
          'seller_id' => 'required',
          'password' => 'required|min:6'
        ],[
          'seller_id.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ]);


        $credential = [
          'seller_id' => $request->seller_id,
          'password' =>$request->password
        ];

       if(Auth::guard('seller')->attempt($credential, $request->member)){
         return redirect()->intended(route('seller.home'));
       }
       
       return redirect()->back()->withInput($request->only('username','remember'));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'seller.login' ));
    }
}
