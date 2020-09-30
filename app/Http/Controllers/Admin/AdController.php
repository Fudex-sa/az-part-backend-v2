<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Http\Requests\Admin\AdRequest;

class AdController extends Controller
{
    
    protected $view = "dashboard.ads.";

    public function all()
    {
        $items = Ad::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(AdRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($request->img){
            $fileName = time().'.'.$request->img->extension();  
            $request->img->move(public_path('uploads'), $fileName);
     
            $data['img'] = $fileName;
        }  

        if($id) 
            $response = Ad::where('id',$id)->update($data);
        
        else $response = Ad::create($data);

        if($response)
            return redirect()->route('admin.ads')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Ad $item)
    {
        $level2['name'] = 'ads';
        $level2['link'] = 'admin.ads';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Ad::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $ad = Ad::find($item);
        $ad->active == 1 ? $active = 0 : $active = 1;

        if( Ad::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

}
