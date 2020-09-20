<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackageRestore;
use App\Models\Package;

class PackageController extends Controller
{
    
    protected $view = "dashboard.packages.";

    public function index()
    {   
        $manual = Package::where('type','manual')->orderby('id','desc')->get();
        $electronic = Package::where('type','electronic')->orderby('id','desc')->get();
        
        return view($this->view.'index',compact('manual','electronic'));
        
    }

    public function edit(Package $item)
    {
    
        return view($this->view.'edit',compact('item'));
    }

    public function store(PackageRestore $request , $id=null)
    {
        
        $data = $request->except('_token','api_token');
 
        if($id) $item = Package::where('id',$id)->update($data);
        
        else $item = Package::create($data);

        if($item)
             return redirect()->route('admin.packages')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen') );

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Package::find($item)->delete()) 
            return 1;

        return 0;
    }

}
