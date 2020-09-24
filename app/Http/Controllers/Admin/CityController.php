<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Region;
use App\Http\Requests\Admin\CityRequest;

class CityController extends Controller
{
    protected $view = "dashboard.cities.";

    public function all(Region $item)
    {
        $items = City::where('region_id',$item->id)->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items','item'));
    }     

    public function store(CityRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($id) 
            $response = City::where('id',$id)->update($data);
        
        else $response = City::create($data);

        if($response)
            return redirect()->route('admin.cities',$request->region_id)->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(City $item)
    {
       
        return view($this->view.'edit',compact('item'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(City::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = City::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( City::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }
}
