<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserPermission;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use App\Models\SupervisorCity;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;
use Excel;
use App\Imports\SupervisorImport;

class SupervisorController extends Controller
{
    
    protected $view = "dashboard.supervisors.";

    public function all()
    {
        $items = Supervisor::with('supervisor_roles')->with('my_sellers')
                
                ->orderby('id','desc')->paginate(pagger());

        $countries = Country::orderby('name_ar','desc')->get();

        $roles = Role::orderby('id','desc')->get();

        return view($this->view.'all',compact('items','countries','roles'));
    }

    public function add()
    {
        $level2['name'] = 'supervisors';
        $level2['link'] = 'admin.supervisors';

        $cols = Schema::getColumnListing('supervisors');
        $roles = Role::orderby('id','desc')->get();

        return view($this->view.'create',compact('cols','roles','level2'));
    }

    public function import()
    {
        
        Excel::import(new SupervisorImport, request()->file('file'));
        return back()->with('success', __('site.success-save'));        
         
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token','role_id','country_id','region_id');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = Supervisor::where('id',$id)->first()->password;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  

        if($id) {
            $item = Supervisor::where('id',$id)->update($data);

            UserRole::roles($id,'supervisor')->delete();

            if($request->role_id){
                foreach($request->role_id as $role){
                    UserRole::create([
                            'role_id' => $role , 'user_id' => $id , 'type' => 'supervisor'
                    ]);
            }}
        }
        else{
            $item = Supervisor::create($data);

            UserRole::roles($item->id,'supervisor')->delete();

            if($request->role_id){
                foreach($request->role_id as $role){
                    UserRole::create([
                            'role_id' => $role , 'user_id' => $item->id , 'type' => 'supervisor'
                    ]);
            }}
        }

        if($item)
            return redirect()->route('admin.supervisors')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(Supervisor $item)
    {
        $level2['name'] = 'supervisors';
        $level2['link'] = 'admin.supervisors';

        $cols = Schema::getColumnListing('supervisors');
        $roles = Role::orderby('id','desc')->get();

        $supervisor_rols = UserRole::user_roles($item->id,'supervisor')->toArray();

        $permissions = Permission::select('section')->groupBy('section')->get();

        $user_permissions = UserPermission::user_permissions($item->id,'supervisor')->toArray();

        $countries = Country::orderby('name_ar','desc')->get();

        $supervisor = Supervisor::with('cities')->whereId($item->id)->first();
          
        if($item->city)
            $region_cities = City::regions($item->city['region_id'])->get();
        else $region_cities = null;

        return view($this->view.'show',compact('item','cols','roles',
                'supervisor_rols','permissions','user_permissions','level2','countries','supervisor','region_cities'));

    }

    public function permissions(Request $request, Supervisor $item)
    {
 
        UserPermission::permissions($item->id,'supervisor')->delete();

            if($request->permissions){
                foreach($request->permissions as $permission){

                    UserPermission::create([
                            'user_id' => $item->id , 'permission' => $permission , 'type' => 'supervisor'
                        ]);
            }}

        return back()->with('success' , __('site.success-save') );
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Supervisor::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Supervisor::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;

        if( Supervisor::where('id',$item)->update(['active' => $active]) )
            return 1;

        return 0;        
    }

    public function cities(Request $request,Supervisor $item)
    {

        SupervisorCity::user_cities($item->id)->delete();

        if($request->cities){
            foreach($request->cities as $city){

                SupervisorCity::create([
                    'user_id' => $item->id , 'region_id' => $request->region_id , 'city_id' => $city
                ]);

        }}

        return back()->with('success' , __('site.success-save') );
        
    }

    public function search(Request $request)
    {
        $role = $request->role;

        if($request->role && $request->city)
            $items = Supervisor::with('supervisor_roles')
                                ->whereHas('supervisor_roles',function($q) use ($role){
                                    $q->where('role_id',$role);
                                })
                                ->where('city_id',$request->city)
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());


        elseif($request->role)
            $items = Supervisor::with('supervisor_roles')
                                ->whereHas('supervisor_roles',function($q) use ($role){
                                    $q->where('role_id',$role);
                                })
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        elseif($request->city)
            $items = Supervisor::where('city_id',$request->city) 
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        else 
            $items = Supervisor::where('name','like','%'.$request->name.'%')
                            ->where('active',$request->status)
                            ->paginate(pagger());
        
        $countries = Country::orderby('name_ar','desc')->get();

        $roles = Role::orderby('id','desc')->get();

        return view($this->view.'all',compact('items','countries','roles'));
    }
}
