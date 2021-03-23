<?php

namespace App\Http\Controllers\AuthStore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;

use Validator;

class RegisterController extends Controller
{
    public function manageMemberStore(Request $request){
        $NUM_PAGE = 10;
        $members = Store::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('authStore/register')->with('NUM_PAGE',$NUM_PAGE)
                                         ->with('page',$page)
                                         ->with('members',$members);
    }

    public function registerStore(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_registerStore(), $this->messages_registerStore());
        if($validator->passes()) {
            $store = $request->all();
            $store['password'] = bcrypt($store['password']);
            $store = Store::create($store);
            if($request->hasFile('image_logo')){
                $image = $request->file('image_logo');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_logo_store/', $filename);
                $path = 'image_upload/image_logo_store/'.$filename;
                $store->image_logo = $filename;
                $store->save();
            }
            $request->session()->flash('alert-success', 'ลงทะเบียนสมาชิกร้านค้าสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'ลงทะเบียนสมาชิกร้านค้าไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function rules_registerStore() {
        return [
            'name' => 'required',
            'password' => 'required',
            'address' => 'required',
        ];
    }

    public function messages_registerStore() {
        return [
            'name.required' => 'กรุณากรอกชื่อร้านค้า',
            'password.required' => 'กรุณารหัสผ่าน',
            'address.required' => 'กรุณากรอกที่อยู่ตัวแทนจำหน่าย',
        ];
    }
}
