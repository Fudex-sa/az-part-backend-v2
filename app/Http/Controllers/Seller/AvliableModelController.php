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
        $avaliable_models = true;
 
        $items = AvailableModel::userBrands(logged_user()->id)->orderby('brand_id','desc')
                                ->orderby('model_id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items','avaliable_models'));
    }

    public function add()
    {
        $avaliable_models = true;

        return view($this->view.'create',compact('avaliable_models'));
    }

    public function edit(AvailableModel $item)
    {
        $avaliable_models = true;

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();

        $models = Modell::models_brand($item->brand_id)->get();

        return view($this->view.'edit',compact('item','brands','models','avaliable_models'));

    }

    public function store(AvailableModelRequest $request,$id = null){
        
        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['city_id'] = logged_user()->city_id;
  
        if(! $id){
            foreach($request->years as $year){
                $data['year'] = $year;

                $exits = AvailableModel::where('user_id',logged_user()->id)->where('brand_id',$request->brand_id)
                                ->where('brand_id',$request->brand_id)->where('year',$year)->first();

                if(! $exits)
                    $item = AvailableModel::create($data);
                
                else $item = null;

            }
        }else{

            $item = AvailableModel::where('id',$id)->update($data);
        }
        

        if($item)
            return redirect()->route('seller.avaliable_models')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.duplicated_row'))->withInput();
         
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(AvailableModel::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function search(Request $request)
    {
        $avaliable_models = true;
 
        if($request->brand)
            $items = AvailableModel::userBrands(logged_user()->id)
                                ->where('brand_id',$request->brand)
                                ->orderby('brand_id','desc')        
                                ->orderby('model_id','desc')->paginate(pagger());

        elseif($request->model)
            $items = AvailableModel::userBrands(logged_user()->id)
                            ->where('brand_id',$request->brand)
                            ->orderby('model_id','desc')        
                            ->orderby('model_id','desc')->paginate(pagger());

        elseif($request->model && $request->year)
            $items = AvailableModel::userBrands(logged_user()->id)
                                ->where('model_id',$request->model)
                                ->where('year',$request->year)
                                ->orderby('brand_id','desc')        
                                ->orderby('model_id','desc')->paginate(pagger());

        else        
            $items = AvailableModel::userBrands(logged_user()->id)
                                ->where('year',$request->year)
                                ->orderby('brand_id','desc')        
                                ->orderby('model_id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items','avaliable_models'));
    }
}
