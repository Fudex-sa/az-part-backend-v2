<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    protected $view = "dashboard.payment_methods.";

    public function all()
    {
        $items = PaymentMethod::orderby('id','desc')->paginate(pagger());
      
        return view($this->view.'all',compact('items'));
    }     

    public function store(Request $request,$id = null)
    {

        $data = $request->except('_token');
        
        if($request->logo){
            $fileName = time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('uploads'), $fileName);
        
            $data['logo'] = $fileName;
        }  

        if($id) 
            $response = PaymentMethod::where('id',$id)->update($data);
        
        else $response = PaymentMethod::create($data);

        if($response)
            return redirect()->route('admin.payment_methods')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(PaymentMethod $item)
    {
       
        return view($this->view.'edit',compact('item'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(PaymentMethod::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = PaymentMethod::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( PaymentMethod::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }
}
