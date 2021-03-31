<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Serialnumber;
use App\model\ProductOut;
use App\model\MessageStore;

use Validator;
use Auth;

class StoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth:store');
    }

    /////////////////////////////// รายการสินค้าออก ///////////////////////////////
    public function productOut(Request $request){
        $NUM_PAGE = 20;
        $product_outs = ProductOut::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/member-store/manageOrderProduct/product-out')->with('NUM_PAGE',$NUM_PAGE)
                                                                          ->with('page',$page)
                                                                          ->with('product_outs',$product_outs);
    }

    public function productOutPost(Request $request){
        $validator = Validator::make($request->all(), $this->rules_productOutPost(), $this->messages_productOutPost());
        if($validator->passes()) {
            $serialnumber = $request->get('serialnumber');
            $film_model_id = Serialnumber::where('serialnumber',$serialnumber)->value('id');
            if($film_model_id == null) {
                $request->session()->flash('alert-danger', 'หมายเลขซีเรียล 16 หลัก ไม่ถูกต้อง');
                return back();
            } else {
                $product_out = new ProductOut;
                $product_out->film_model_id = $film_model_id;
                $product_out->serialnumber = $serialnumber;
                $product_out->save();

                $serialnumber_status = Serialnumber::findOrFail($film_model_id);
                $serialnumber_status->status = 'ใช้งานแล้ว';
                $serialnumber_status->update();
                $request->session()->flash('alert-success', 'นำสินค้าออกสำเร็จ');
                return back();
            }
        }
        else {
            $request->session()->flash('alert-danger', 'นำสินค้าออกไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    // ติดต่อสอบถาม
    public function contactUs(){
        return view('backend/member-store/contact/contact-us');
    }

    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(), $this->rules_sendMessage(), $this->messages_sendMessage());
        if($validator->passes()) {
            $message = $request->all();
            $message = MessageStore::create($message);
            $request->session()->flash('alert-success', 'ส่งข้อความติดต่อสำเร็จ รอการติดต่อกลับ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'ส่งข้อความติดต่อไม่สำเร็จ');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function messageHistory(Request $request){
        $NUM_PAGE = 20;
        $messages = MessageStore::where('store_id',Auth::guard('store')->user()->id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/member-store/contact/message-history')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('messages',$messages);
    }

    public function rules_productOutPost() {
        return [
            'serialnumber' => 'required',
        ];
    }

    public function messages_productOutPost() {
        return [
            'serialnumber.required' => 'กรุณากรอกหมายเลขซีเรียล 16 หลัก',
        ];
    }

    public function rules_sendMessage() {
        return [
            'subject' => 'required',
            'message' => 'required',
        ];
    }

    public function messages_sendMessage() {
        return [
            'subject.required' => 'กรุณากรอกหัวข้อเรื่อง',
            'message.required' => 'กรุณากรอกข้อความที่ต้องการส่ง',
        ];
    }
}
