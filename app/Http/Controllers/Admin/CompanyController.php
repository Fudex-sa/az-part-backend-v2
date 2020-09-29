<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;

class CompanyController extends Controller
{
    
    protected $view = "dashboard.companies.";

    public function all()
    {
        $items = Company::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $cols = Schema::getColumnListing('companies');

        return view($this->view.'create',compact('cols'));
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token','country_id','region_id');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = Company::where('id',$id)->first()->password;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
        
            $data['photo'] = $fileName;
        }  

        if($id) 
            $response = Company::where('id',$id)->update($data);
        
        else $response = Company::create($data);

        if($response)
            return redirect()->route('admin.companies')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(Company $item)
    {
        $cols = Schema::getColumnListing('companies');

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

        if(Company::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Company::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( Company::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

    public function search(Request $request)
    {
        
       
        if($request->mobile)
            $items = Company::where('mobile',$request->mobile)
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->city)
            $items = Company::where('city_id',$request->city)                     
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->name && $request->mobile)
            $items = Company::where('name','like','%'.$request->name.'%')
                                ->where('mobile',$request->mobile)
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        elseif($request->city && $request->name && $request->mobile)
            $items = Company::where('city_id',$request->city) 
                                ->where('mobile',$request->mobile)  
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        else 
            $items = Company::where('name','like','%'.$request->name.'%')
                            ->where('active',$request->status)
                            ->paginate(pagger());
         
        return view($this->view.'all',compact('items'));
    }

}
