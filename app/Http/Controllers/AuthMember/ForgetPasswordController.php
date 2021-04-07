<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;

use Auth;
use Hash;
use Validator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ForgetPasswordController extends Controller
{
    public function index(){
        return view('authMember/passwords/forget');
    }

    public function forgetForm(Request $request){
        $validator = Validator::make($request->all(), $this->rules_forgetForm(), $this->messages_forgetForm());
        if($validator->passes()) {
            $phone = $request->get('phone');
            $member = Member::where('phone',$phone)
                            ->get();
            
            $password = Member::where('phone',$phone)
                              ->value('password');

            if(count($member) > 0 && $password != NULL) {
                $request->session()->flash('alert-success', 'ยืนยันหมายเลขโทรศัพท์สำเร็จ กรุณากรอกรหัสผ่านใหม่');
                return View::make('authMember/passwords/forget-confirm')->with('phone', $phone);
            }
        }
        else {
            $request->session()->flash('alert-danger', 'ยืนยันหมายเลขโทรศัพท์ไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้อง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function confirm(Request $request) {
        return view('authMember/passwords/forget-confirm')->with('phone', $phone);
    }

    public function UpdatePassword(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_UpdatePassword(), $this->messages_UpdatePassword());
        if($validator->passes()) {
            $phone = $request->get('phone');
            $password = $request->get('password');
            
            $id = Member::where('phone',$phone)
                        ->value('id');
                        
                $member = Member::find($id);
                $member->password = Hash::make($password);
                $member->save();
                Auth::guard('member')->logout();

            $request->session()->flash('alert-success', 'เปลี่ยนรหัสผ่านสำเร็จ');
            return redirect()->route('member.login');
        }
        else {
            $request->session()->flash('alert-danger', 'เปลี่ยนรหัสผ่านไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้อง');
            return back()->withErrors($validator)->withInput();
        }
        
    }

    /////////////////////////////// validate ///////////////////////////////
    public function rules_forgetForm() {
        return [
            'phone' => 'required',
        ];
    }

    public function messages_forgetForm() {
        return [
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์ที่ลงทะเบียนไว้',
        ];
    }

    public function rules_UpdatePassword() {
        return [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages_UpdatePassword() {
        return [
            'password.required' => 'กรุณากรอกรหัสผ่านใหม่',
            'password.confirmed' => "รหัสผ่านยืนยันไม่ตรงกับรหัสผ่านใหม่",
            'password_confirmation.required' => "กรุณายืนยันรหัสผ่าน",
        ];
    }
}
