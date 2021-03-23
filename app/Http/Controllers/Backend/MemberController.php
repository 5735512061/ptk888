<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\MessageCustomer;
use App\model\DataWarrantyMember;
use App\model\Serialnumber;

use Validator;

class MemberController extends Controller
{
    public function __construct(){
        $this->middleware('auth:member');
    }

    public function registerWarranty() {
        return view('backend/customer/register-warranty');
    }

    public function registerWarrantyPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_warranty(), $this->messages_warranty());
        if($validator->passes()) {
            $warranty = $request->all();
            $serialnumber = $request->get('serialnumber');
            $film_model = $request->get('film_model');
            $serialnumber_product = Serialnumber::where('serialnumber',$serialnumber)
                                                ->where('film_model',$film_model)
                                                ->where('status','ใช้งานแล้ว')->get();
            $serialnumber_not_product_out = Serialnumber::where('serialnumber',$serialnumber)
                                                        ->where('film_model',$film_model)
                                                        ->where('status','ยังไม่ใช้งาน')->get();
                if(count($serialnumber_product) != 0) {
                    $warranty = DataWarrantyMember::create($warranty);
                    $request->session()->flash('alert-success', 'ลงทะเบียนรับประกันสินค้าเรียบร้อยค่ะ');
                    return back();
                } elseif(count($serialnumber_not_product_out) != 0) { 
                    $request->session()->flash('alert-danger', 'ลงทะเบียนรับประกันสินค้าไม่สำเร็จ หมายเลขซีเรียลยังไม่ถูกลงทะเบียน กรุณาติดต่อจุดบริการ');
                    return back();
                }
                $request->session()->flash('alert-danger', 'ลงทะเบียนรับประกันสินค้าไม่สำเร็จ กรุณาตรวจสอบหมายเลขซีเรียล 16 หลัก และประเภทของฟิล์ม');
                return back();
        }else{
            $request->session()->flash('alert-danger', 'ลงทะเบียนรับประกันสินค้าไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function sendMessage(Request $request) {
        $message = $request->all();
        $message = MessageCustomer::create($message);
        return back();
    }

    public function rules_warranty() {
        return [
            'film_model' => 'required',
            'serialnumber' => 'required|unique:data_warranty_members',
            'phone_model' => 'required',
            'date_order' => 'required',
            'service_point' => 'required',
            'address_service' => 'required',
        ];
    }

    public function messages_warranty() {
        return [
            'film_model.required' => 'กรุณาเลือกประเภทฟิล์มของรุ่นที่ลงทะเบียน',
            'serialnumber.required' => 'กรุณากรอกหมายเลขซีเรียล 16 หลัก',
            'serialnumber.unique' => 'หมายเลขนี้เคยลงทะเบียนประกันสินค้าแล้ว',
            'phone_model.required' => 'กรุณากรอกยี่ห้อ/รุ่นโทรศัพท์',
            'date_order.required' => 'กรุณากรอกวันที่สั่งซื้อ',
            'service_point.required' => 'กรุณาเลือกจุดที่ใช้บริการ',
            'address_service.required' => 'กรุณากรอกสถานที่ของจุดบริการ',
        ];
    }   
}
