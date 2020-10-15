<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Http\Requests\Admin\CouponRequest;

class CouponController extends Controller
{
    
    protected $view = "dashboard.coupons.";

    public function all()
    {
        $items = Coupon::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(CouponRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = Coupon::where('id',$id)->update($data);
        
        else $response = Coupon::create($data);

        if($response)
            return redirect()->route('admin.coupons')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Coupon $item)
    {
        $level2['name'] = 'coupons';
        $level2['link'] = 'admin.coupons';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Coupon::find($item)->delete()) 
            return 1;

        return 0;
    }


}
