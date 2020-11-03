<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryRegion;

class DeliveryRegionController extends Controller
{
    protected $view = "dashboard.delivery_regions.";

    public function all()
    {
        $items = DeliveryRegion::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(Request $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = DeliveryRegion::where('id',$id)->update($data);
        
        else $response = DeliveryRegion::create($data);

        if($response)
            return redirect()->route('admin.delivery_regions')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(DeliveryRegion $item)
    {
        $level2['name'] = 'tashlih_regions';
        $level2['link'] = 'admin.delivery_regions';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(DeliveryRegion::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = DeliveryRegion::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( DeliveryRegion::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }
}
