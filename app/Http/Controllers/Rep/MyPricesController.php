<?php

namespace App\Http\Controllers\Rep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepPrice;
use App\Models\RepCarSize;

class MyPricesController extends Controller
{
    protected $view = "rep.my_prices.";

    public function index()
    {
        $my_prices = true;

        $items = RepPrice::myCities(logged_user()->id)->get();
        
        return view($this->view . 'all' , compact('items','my_prices') );
    }

    public function store(Request $request,$id = null)
    {
         
        $data = $request->except('_token','country_id','region_id');
        $data['rep_id'] = logged_user()->id;

         if($id) 
            $item = RepPrice::where('id',$id)->update($data);
        
        else $item = RepPrice::create($data);

        if($item)
            return redirect()->route('rep.my_prices')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $row = RepPrice::find($item);
        $row->active == 1 ? $active = 0 : $active = 1;

        if( RepPrice::where('id',$item)->update(['active' => $active]) )
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
