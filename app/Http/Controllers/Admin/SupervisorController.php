<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;

class SupervisorController extends Controller
{
    
    protected $view = "dashboard.supervisors.";

    public function all()
    {
        $items = Supervisor::with('supervisor_roles')->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $level2['name'] = 'supervisors';
        $level2['link'] = 'admin.supervisors';

        $cols = Schema::getColumnListing('supervisors');
        $roles = Role::orderby('id','desc')->get();

        return view($this->view.'create',compact('cols','roles','level2'));
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token','role_id');

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

        return view($this->view.'show',compact('item','cols','roles',
                'supervisor_rols','permissions','user_permissions','level2'));

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

}
