<?php

namespace App\Http\Controllers\AuthStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('authStore.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
          'username' => 'required',
          'password' => 'required|min:6'
        ],[
          'username.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ]);


        $credential = [
          'username' => $request->username,
          'password' =>$request->password
        ];

       if(Auth::guard('store')->attempt($credential, $request->member)){
         return redirect()->intended(route('store.home'));
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
        Auth::guard('store')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'store.login' ));
    }
}
