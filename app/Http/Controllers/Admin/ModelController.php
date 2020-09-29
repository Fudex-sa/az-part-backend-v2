<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Modell;
use App\Http\Requests\Admin\ModelRequest;

class ModelController extends Controller
{
    
    protected $view = "dashboard.models.";

    public function all(Brand $brand)
    {
        $level2['name'] = 'brands';
        $level2['link'] = 'admin.brands';

        $items = Modell::where('brand_id',$brand->id)->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items','brand','level2'));
    }     

    public function store(ModelRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($id) 
            $response = Modell::where('id',$id)->update($data);
        
        else $response = Modell::create($data);

        if($response)
            return redirect()->route('admin.models',$request->brand_id)->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Modell $item)
    {
        
        return view($this->view.'edit',compact('item'));

    }

    public function delete(Request $request){
        $item = $request->input('id');
 
        if(Modell::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');
 
        if( Modell::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

}
