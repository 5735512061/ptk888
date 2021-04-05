<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Hash;
use App\Member;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('authMember/passwords/change');
    }

    public function changePassword(Request $request)
    {
       $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
       ],[
            'oldpassword.required' => "กรุณากรอกรหัสผ่านเก่า",
            'password.required' => "กรุณากรอกรหัสผ่านใหม่",
            'password.confirmed' => "รหัสผ่านยืนยันไม่ตรงกับรหัสผ่านใหม่",
            'password_confirmation.required' => "กรุณายืนยันรหัสผ่าน",
       ]);

        $hashedPassword = Auth::guard('member')->user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)) {
            $member = Member::find(Auth::guard('member')->id());
            $member->password = Hash::make($request->password);
            $member->save();
            Auth::guard('member')->logout();
            return redirect()->route('member.login')->with('successMsg',"เปลี่ยนรหัสผ่านสำเร็จ");
        }else {
            return redirect()->back()->with('errorMsg',"รหัสผ่านไม่ถูกต้อง");
        }
       
    }
}
