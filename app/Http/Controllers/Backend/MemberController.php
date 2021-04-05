<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\MessageCustomer;
use App\model\DataWarrantyMember;
use App\model\WarrantyConfirm;
use App\model\Serialnumber;
use App\model\OrderCustomer;
use App\model\Product;

use App\Member;

use Carbon\Carbon;

use Auth;
use Validator;

class MemberController extends Controller
{
    public function __construct(){
        $this->middleware('auth:member');
    }

    // ลงทะเบียนรับประกันฟิล์ม และเคลมสินค้า
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
                                                ->where('status','พร้อมใช้งาน')->get();
            $serialnumber_not_product_out = Serialnumber::where('serialnumber',$serialnumber)
                                                        ->where('film_model',$film_model)
                                                        ->where('status','ยังไม่ใช้งาน')->get();
                if(count($serialnumber_product) != 0) {
                    $warranty = DataWarrantyMember::create($warranty);
                    $serialnumber_id = Serialnumber::where('serialnumber',$serialnumber)->value('id');
                    $serialnumber = Serialnumber::findOrFail($serialnumber_id);
                    $serialnumber->status = 'ใช้งานแล้ว';
                    $serialnumber->update();
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

    public function claimProduct(){
        return view('backend/customer/claim-product');
    }
    
    public function claimProductConfirm(Request $request){
        $phone = $request->get('phone');
        $member_id = Member::where('phone',$phone)->value('id');
        $NUM_PAGE = 20;
        $data_warrantys = DataWarrantyMember::where('member_id',$member_id)->paginate($NUM_PAGE);
        $date_now = Carbon::now()->format('Y-m-d');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        
            if(count($data_warrantys) == 0) {
                $request->session()->flash('alert-danger', 'ยังไม่เคยลงทะเบียนรับประกันสินค้า');
                return back();
            }
            else {
                return view('backend/customer/claim-product-confirm')->with('NUM_PAGE',$NUM_PAGE)
                                                                     ->with('page',$page)
                                                                     ->with('data_warrantys',$data_warrantys)
                                                                     ->with('date_now',$date_now);
            }
    }

    public function claimProductForm($id){
        $claim_product = DataWarrantyMember::findOrFail($id);
        return view('backend/customer/claim-product-form')->with('claim_product',$claim_product);
    }

    public function claimProductPost(Request $request){
        $validator = Validator::make($request->all(), $this->rules_claimProductPost(), $this->messages_claimProductPost());
        if($validator->passes()) {
            $claim_product = $request->all();
            $claim_product = WarrantyConfirm::create($claim_product);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_claim_product/', $filename);
                $path = 'image_upload/image_claim_product/'.$filename;
                $claim_product->image = $filename;
                $claim_product->save();
            }
            $request->session()->flash('alert-success', 'บันทึกข้อมูลสำเร็จ กรุณารอการยืนยันจากระบบ');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'เคลมสินค้าไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
            return back()->withErrors($validator)->withInput();   
        }
    }

    // ติดต่อสอบถาม
    public function sendMessage(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_sendMessage(), $this->messages_sendMessage());
        if($validator->passes()) {
            $message = $request->all();
            $message = MessageCustomer::create($message);
            $request->session()->flash('alert-success', 'ส่งข้อความติดต่อสำเร็จ กรุณารอการตอบกลับจากเจ้าหน้าที่');
            return redirect()->action('Backend\\MemberController@answerMessage');
        } else {
            $request->session()->flash('alert-danger', 'ส่งข้อความติดต่อไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function answerMessage(Request $request){
        $NUM_PAGE = 10;
        $customer_id = Auth::guard('member')->user()->id;
        $answer_messages = MessageCustomer::where('customer_id',$customer_id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/account/answer-message')->with('NUM_PAGE',$NUM_PAGE)
                                                      ->with('page',$page)
                                                      ->with('answer_messages',$answer_messages);
    }

    // account
    public function profile(){
        $member = Auth::guard('member')->user();
        return view('frontend/account/profile')->with('member',$member);
    }

    public function editProfile($id){
        $member = Member::findOrFail($id);
        return view('frontend/account/edit-profile')->with('member',$member);
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateProfile(), $this->messages_updateProfile());
        if($validator->passes()) {
            $id = $request->get('id');
            $member = Member::findOrFail($id);
            $member->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลส่วนตัวสำเร็จ');
            return redirect()->action('Backend\\MemberController@profile');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลส่วนตัวไม่สำเร็จ กรุณากรอกข้อมูลให้ครบถ้วน');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function orderHistory(){
        $customer_id = Auth::guard('member')->user()->id;
        $orders = OrderCustomer::where('customer_id',$customer_id)->groupBY('bill_number')->get();
        $productRecommends = Product::where('product_recommend','ใช่')->get();
        return view('frontend/account/order-history')->with('orders',$orders)
                                                     ->with('productRecommends',$productRecommends);
    }

    public function orderHistoryDetail($id){
        $order = OrderCustomer::findOrFail($id);
        return view('frontend/account/order-history-detail')->with('order',$order);
    }

    // validate
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
    
    public function rules_claimProductPost() {
        return [
            'reason' => 'required',
            'image' => 'required',
            'address' => 'required',
        ];
    }

    public function messages_claimProductPost() {
        return [
            'reason.required' => 'กรุณากรอกสาเหตุการเคลมสินค้า',
            'image.required' => 'กรุณาเลือกไฟล์รูปภาพ 1 รูป',
            'address.required' => 'กรุณากรอกที่อยู่จัดส่งสินค้า',
        ];
    }  
    
    public function rules_sendMessage() {
        return [
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ];
    }

    public function messages_sendMessage() {
        return [
            'name.required' => 'กรุณากรอกขื่อ-นามสกุล',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'subject.required' => 'กรุณากรอกหัวข้อเรื่องที่ต้องการสอบถาม',
            'message.required' => 'กรุณากรอกข้อความที่ต้องการติดต่อ',
        ];
    }

    public function rules_updateProfile() {
        return [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'address' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
        ];
    }

    public function messages_updateProfile() {
        return [
            'name.required' => 'กรุณากรอกขื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งาน (เป็นภาษาอังกฤษ)',
            'address.required' => 'กรุณากรอกที่อยู่ติดต่อ',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
        ];
    }
}
