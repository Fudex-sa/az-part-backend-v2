<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Region;
use App\Http\Requests\Admin\RegionRequest;

class RegionController extends Controller
{
    protected $view = "dashboard.regions.";

    public function all(Country $item)
    {
        $items = Region::where('country_id',$item->id)->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items','item'));
    }     

    public function store(RegionRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($id) 
            $response = Region::where('id',$id)->update($data);
        
        else $response = Region::create($data);

        if($response)
            return redirect()->route('admin.regions',$request->country_id)->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Region $item)
    {
       
        return view($this->view.'edit',compact('item'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Region::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Region::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( Region::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }
}
