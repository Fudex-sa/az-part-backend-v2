<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSite;
use App\Http\Requests\Admin\SettingRequest;

class DataSiteController extends Controller
{
    
    protected $view = "dashboard.data_site.";

    public function all()
    {
        $items = DataSite::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(SettingRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = DataSite::where('id',$id)->update($data);
        
        else $response = DataSite::create($data);

        if($response)
            return redirect()->route('admin.data_sites')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(DataSite $item)
    {
        $level2['name'] = 'data_site';
        $level2['link'] = 'admin.data_sites';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(DataSite::find($item)->delete()) 
            return 1;

        return 0;
    }


}
