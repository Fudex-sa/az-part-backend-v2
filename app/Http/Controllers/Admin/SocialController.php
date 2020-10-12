<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use App\Http\Requests\Admin\SocialRequest;

class SocialController extends Controller
{
    
    protected $view = "dashboard.socials.";

    public function all()
    {
        $items = Social::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(SocialRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = Social::where('id',$id)->update($data);
        
        else $response = Social::create($data);

        if($response)
            return redirect()->route('admin.socials')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Social $item)
    {
        $level2['name'] = 'social';
        $level2['link'] = 'admin.socials';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Social::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $row = Social::find($item);
        $row->active == 1 ? $active = 0 : $active = 1;

        if( Social::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

}
