<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Serialnumber;
use App\model\ProductOut;

use Validator;

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
}
