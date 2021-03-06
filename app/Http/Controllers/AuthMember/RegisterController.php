<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use Validator;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function ShowRegisterFormMember(){
        return view('authMember/register');
    }

    public function registerMember(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_registerMember(), $this->messages_registerMember());
        if($validator->passes()) {
            $member = $request->all();
            $date = Carbon::now()->format('Y-m-d');
            $member['password'] = bcrypt($member['password']);
            $member['date'] = $date;
            $member = Member::create($member);
            $request->session()->flash('alert-success', 'สมัครสมาชิกสำเร็จ');
            return redirect()->intended(route('member.login'));
        }
        else {
            $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน');
            return back()->withErrors($validator)->withInput();
        }
    }

    // Validate
    public function rules_registerMember() {
        return [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|unique:members',
            'username' => 'required|unique:members',
            'address' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages_registerMember() {
        return [
            'name.required' => 'กรุณากรอกขื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'phone.unique' => 'เบอร์โทรศัพท์ใช้ในการสมัครสมาชิกแล้ว',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งาน (เป็นภาษาอังกฤษ)',
            'username.unique' => 'ชื่อผู้ใช้นี้มีผู้อื่นใช้แล้ว ลองใช้ชื่ออื่น',
            'address.required' => 'กรุณากรอกที่อยู่ติดต่อ',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
            'password.required' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 หลัก",
            'password.confirmed' => "รหัสผ่านยืนยันไม่ตรงกับรหัสผ่านใหม่",
            'password_confirmation.required' => "กรุณายืนยันรหัสผ่าน",
        ];
    }
}
