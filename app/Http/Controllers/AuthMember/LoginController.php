<?php

namespace App\Http\Controllers\AuthMember;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('authMember.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
          'member_id' => 'required',
          'password' => 'required|min:6'
        ],[
          'member_id.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ]);


        $credential = [
          'member_id' => $request->member_id,
          'password' =>$request->password
        ];

       if(Auth::guard('member')->attempt($credential, $request->member)){
         return redirect()->intended(route('member.home'));
       }
       
       return redirect()->back()->withInput($request->only('member_id','remember'));
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
        Auth::guard('member')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'member.login' ));
    }
}
