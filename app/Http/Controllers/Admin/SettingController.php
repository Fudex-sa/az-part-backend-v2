<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\Admin\SettingRequest;

class SettingController extends Controller
{
    
    protected $view = "dashboard.settings.";

    public function all()
    {
        $items = Setting::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(Request $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = Setting::where('id',$id)->update($data);
        
        else $response = Setting::create($data);

        if($response)
            return redirect()->route('admin.settings')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Setting $item)
    {
        $level2['name'] = 'settings';
        $level2['link'] = 'admin.settings';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Setting::find($item)->delete()) 
            return 1;

        return 0;
    }

}
