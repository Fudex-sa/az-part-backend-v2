<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\AvailableModel;
use App\Http\Requests\Seller\AvailableModelRequest;

class AvliableModelController extends Controller
{
    protected $view = "sellers.available_brands.";

    public function index()
    {
         
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();

        $items = AvailableModel::userBrands(user_id())->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('brands','items'));
    }

    public function edit(AvailableModel $item)
    {
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();

        $models = Modell::models_brand($item->brand_id)->get();

        return view($this->view.'edit',compact('item','brands','models'));

    }

    public function store(AvailableModelRequest $request,$id = null){
        
        $data = $request->except('_token');
        
        $data['user_id'] = user_id();
  
        $id ? $item = AvailableModel::where('id',$id)->update($data) : 

        $item = AvailableModel::create($data);

        if($item)
            return redirect()->route('seller.avaliable_models')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();
         
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(AvailableModel::find($item)->delete()) 
            return 1;

        return 0;
    }

}
