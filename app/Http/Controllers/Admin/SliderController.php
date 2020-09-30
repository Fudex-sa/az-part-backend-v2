<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\Admin\SliderRequest;

class SliderController extends Controller
{
    
    protected $view = "dashboard.sliders.";

    public function all()
    {
        $items = Slider::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(SliderRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($request->img){
            $fileName = time().'.'.$request->img->extension();  
            $request->img->move(public_path('uploads'), $fileName);
     
            $data['img'] = $fileName;
        }  

        if($id) 
            $response = Slider::where('id',$id)->update($data);
        
        else $response = Slider::create($data);

        if($response)
            return redirect()->route('admin.sliders')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Slider $item)
    {
        $level2['name'] = 'sliders';
        $level2['link'] = 'admin.sliders';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Slider::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $slider = Slider::find($item);
        $slider->active == 1 ? $active = 0 : $active = 1;

        if( Slider::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }



}
