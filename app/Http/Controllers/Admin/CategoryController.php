<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $view = "dashboard.categories.";

    public function all()
    {
        $items = Category::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }     

    public function store(Request $request,$id = null)
    {
         
        $data = $request->except('_token');

        if($id) 
            $response = Category::where('id',$id)->update($data);
        
        else $response = Category::create($data);

        if($response)
            return redirect()->route('admin.categories',$request->region_id)->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Category $item)
    {
       
        return view($this->view.'edit',compact('item'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Category::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Category::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( Category::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }
}
