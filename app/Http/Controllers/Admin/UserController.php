<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;
use Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    
    protected $view = "dashboard.users.";

    public function all()
    {
        $items = User::with('city')->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $cols = Schema::getColumnListing('users');
 
        return view($this->view.'create',compact('cols'));
    }

    public function import()
    {
        
        Excel::import(new UsersImport, request()->file('file'));
        return back()->with('success', __('site.success-save'));        
         
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token','country_id','region_id');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = User::where('id',$id)->first()->password;

        $request->available_orders ? $data['available_orders'] = $request->available_orders 
                    : $data['available_orders'] = 0;
 
        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
        
            $data['photo'] = $fileName;
        }  

        if($id) 
            $response = User::where('id',$id)->update($data);
        
        else $response = User::create($data);

        if($response)
            return redirect()->route('admin.users')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(User $item)
    {
        $cols = Schema::getColumnListing('users');
        
        if($item->city){
            $region_cities = City::regions($item->city['region_id'])->get();
            $regions = Region::where('country_id',$item->city->region['country_id'])->orderby('name_ar','desc')->get();
        }            
        else {
            $region_cities = null;
            $regions = null;
        }
        
        return view($this->view.'show',compact('item','cols','region_cities','regions'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(User::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = User::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( User::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

    public function search(Request $request)
    {
         
        if($request->mobile)
            $items = User::where('name',$request->mobile)
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->city)
            $items = User::where('city_id',$request->city)                     
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->name && $request->mobile)
            $items = User::where('name','like','%'.$request->name.'%')
                                ->where('name',$request->mobile)
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        elseif($request->city && $request->name && $request->mobile)
            $items = User::where('city_id',$request->city) 
                                ->where('name',$request->mobile)
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        else 
            $items = User::where('name','like','%'.$request->name.'%')
                            ->where('active',$request->status)
                            ->paginate(pagger());
         
        return view($this->view.'all',compact('items'));
    }

}
