<?php

namespace App\Http\Controllers\Rep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepPrice;
use App\Models\RepCarSize;
use App\Models\DeliveryRegion;
use App\Http\Requests\Rep\MyPricesRequest;

class MyPricesController extends Controller
{
    protected $view = "rep.my_prices.";

    public function index()
    {
        $my_prices = true;

        $items = RepPrice::myCities(logged_user()->id)->orderby('id','desc')->get();
        $delivery_regions = DeliveryRegion::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'all' , compact('items','my_prices','delivery_regions') );
    }

    public function edit($id)
    {
        $my_prices = true;

        $item = RepPrice::where('id',$id)->first();

        $delivery_regions = DeliveryRegion::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'edit' , compact('item','my_prices','delivery_regions') );
    }

    public function store(MyPricesRequest $request,$id = null)
    {
         
        $data = $request->except('_token','country_id','region_id');
        $data['rep_id'] = logged_user()->id;

         if($id) 
            $item = RepPrice::where('id',$id)->update($data);
        
        else{

            $exists = RepPrice::where('rep_id',logged_user()->id)->where('_from',$request->_from)
                                ->where('city_id',$request->city_id)
                                ->where('car_size',$request->car_size)
                                ->first();
        
            if($exists)
                return back()->with('failed' , __('site.duplicated_region_delivery'))->withInput();

            $item = RepPrice::create($data);
        } 

        if($item)
            return redirect()->route('rep.my_prices')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $row = RepPrice::find($item);
        $row->active == 1 ? $active = 0 : $active = 1;

        $item = RepPrice::where('id',$item)->update(['active' => $active]);

        if($item)
            return 1;

        return 0;          
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(RepPrice::find($item)->delete()) 
            return 1;

        return 0;
    }
 
}
