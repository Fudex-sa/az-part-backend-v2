<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Region;
use App\Models\City;
use App\Models\Brand;
use App\Models\AvailableModel;
use App\Models\DeliveryRegion;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Seller\AvailableModelRequest;

class SellerController extends Controller
{
    
    protected $view = "dashboard.sellers.";

    public function all()
    {
        if(auth('admin')->user()->id == 1)
            $items = Seller::orderby('id','desc')->paginate(pagger());
        else 
            $items = Seller::where('created_by',auth('admin')->user()->id)
                    ->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $cols = Schema::getColumnListing('sellers');

        return view($this->view.'create',compact('cols'));
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token','country_id');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = Seller::where('id',$id)->first()->password;

        $data['created_by'] = auth('admin')->user()->id;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
        
            $data['photo'] = $fileName;
        }  

        if($id) 
            $response = Seller::where('id',$id)->update($data);
        
        else $response = Seller::create($data);

        if($response)
            return redirect()->route('admin.sellers')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(Seller $item)
    {
        $cols = Schema::getColumnListing('sellers');

        if($item->city){
            $region_cities = City::regions($item->city['region_id'])->get();
            $regions = Region::where('country_id',$item->city->region['country_id'])->orderby('name_ar','desc')->get();
        }            
        else {
            $region_cities = null;
            $regions = null;
        }

        $avaliable_models = AvailableModel::userBrands($item->id)->orderby('brand_id','desc')
                                ->orderby('model_id','desc')->paginate(pagger());

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        $delivery_regions = DeliveryRegion::all();

        return view($this->view.'show',compact('item','cols','region_cities','regions'
                            ,'avaliable_models','brands','delivery_regions'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Seller::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Seller::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( Seller::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

    public function search(Request $request)
    {
         
        if($request->mobile)
            $items = Seller::where('name',$request->mobile)
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->city)
            $items = Seller::where('city_id',$request->city)                     
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->name && $request->mobile)
            $items = Seller::where('name','like','%'.$request->name.'%')
                                ->where('name',$request->mobile)
                                ->where('active',$request->status)                                
                                ->paginate(pagger());
        

        elseif($request->city && $request->name && $request->mobile)
            $items = Seller::where('city_id',$request->city) 
                                ->where('name',$request->mobile)
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        else 
            $items = Seller::where('name','like','%'.$request->name.'%')
                            ->where('active',$request->status)
                            ->paginate(pagger());
         
        return view($this->view.'all',compact('items'));
    }

    public function available_brand_store(AvailableModelRequest $request)
    {
        $seller = Seller::find($request->user_id);

        $data = $request->except('_token');
        $data['city_id'] = $seller->city_id;

        $item = AvailableModel::create($data);

        if($item)
            return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

}
