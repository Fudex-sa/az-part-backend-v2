<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Modell;
use App\Http\Requests\Admin\BrandRequest;

class BrandController extends Controller
{
    protected $view = "dashboard.brands.";

    public function all()
    {
        $items = Brand::with('models')->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(BrandRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($request->logo){
            $fileName = time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('uploads/brands'), $fileName);
     
            $data['logo'] = $fileName;
        }

         if($id) 
            $response = Brand::where('id',$id)->update($data);
        
        else $response = Brand::create($data);

        if($response)
            return redirect()->route('admin.brands')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Brand $item)
    {
        $level2['name'] = 'brands';
        $level2['link'] = 'admin.brands';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        Modell::models_brand($item)->delete();

        if(Brand::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function search(Request $request)
    {
 
        $items = Brand::where('name_ar','like','%'.$request->search_txt.'%')
                        ->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));

    }

}
