<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarComment;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\City;

class CarController extends Controller
{
    protected $view = "dashboard.cars.";

    public function damaged()
    {
        $items = Car::where('type','damaged')->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'damaged',compact('items'));
    }

    public function antiques()
    {
        $items = Car::where('type','antique')->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'antique',compact('items'));
    }

    public function comments(Car $car)
    {
        $items = CarComment::where('car_id',$car->id)->with('car')->with('user')->with('company')
                            ->orderby('id','desc')->paginate(pagger());
         
        return view($this->view . 'comments',compact('items','car'));
    }

    public function edit($id)
    {
        $item = Car::where('id',$id)->with('imgs')->with('user')->with('company')->first();
        
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        $models = Modell::models_brand($item->brand_id)->orderby('name_'.my_lang(),'desc')->get();
        $cities = City::regions($item->region_id)->orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'edit',compact('item','brands','models','cities'));
    }

    public function comment_delete(Request $request)
    {        
        $item = $request->input('id');

        if(CarComment::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function comment_activate(Request $request)
    {
        $item = $request->input('id');

        $row = CarComment::find($item);
        $row->approved == 1 ? $approved = 0 : $approved = 1;

        if( CarComment::where('id',$item)->update(['approved' => $approved]) )
            return 1;

        return 0;        
    }

    public function store($id = null , Request $request)
    {
        
        $data = $request->except('_token','original_manufacture_year','replica_manufacture_year','date_auction');
        // $data['user_id'] = logged_user()->id;
        // $data['user_type'] = user_type();
 
        $id ? $item = Car::where('id',$id)->update($data) :  $item = Car::create($data);

        if($item){
            if($request->type == 'damaged')
                return redirect()->route('admin.damaged')->with('success' , __('site.success-save') );
            else 
                return redirect()->route('admin.antiques')->with('success' , __('site.success-save') );
        }
        return back()->with('failed' , __('site.error-happen'))->withInput();

    }


    public function imgs_store(Request $request,$id)
    {
        if($request->imgs){
            foreach($request->imgs as $img){
                $fileName = time().'.'.$img->extension();  
                $img->move(public_path('uploads'), $fileName);
        
                $carImg = CarImage::create(['car_id' => $item->id , 'photo' => $fileName]);
            }            
        } 

        return redirect()->route('control.cars')->with('success' , __('site.success-save') );

    }
}
