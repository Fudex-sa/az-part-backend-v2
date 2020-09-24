<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Requests\Admin\CountryRequest;

class CountryController extends Controller
{
    
    protected $view = "dashboard.countries.";

    public function all()
    {
        $items = Country::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }     

    public function store(CountryRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($id) 
            $response = Country::where('id',$id)->update($data);
        
        else $response = Country::create($data);

        if($response)
            return redirect()->route('admin.countries')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Country $item)
    {
       
        return view($this->view.'edit',compact('item'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Country::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Country::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( Country::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

}
