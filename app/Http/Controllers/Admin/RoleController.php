<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    
    protected $view = "dashboard.roles.";

    public function all()
    {
         
        $items = Role::with('role_permissions')->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $level2['name'] = 'roles';
        $level2['link'] = 'admin.roles';

        $permissions = Permission::select('section')->groupBy('section')->get();

        return view($this->view.'create',compact('permissions','level2'));
    }

    public function store(RoleRequest $request,$id = null)
    {         
        $data = $request->except('_token','api_token','permissions');
  
        if($id) {

            $item = Role::where('id',$id)->update($data);

            RolePermission::permissions($id)->delete();

            if($request->permissions){
                foreach($request->permissions as $permission){

                        RolePermission::create([
                            'role_id' => $id , 'permission' => $permission
                        ]);
            }}
        }

        else{
            $item = Role::create($data);
            
            if($request->permissions){
                foreach($request->permissions as $permission){
     
                    // if(RolePermission::duplicatedRole($item->id,$permission)->count() < 1)
    
                        RolePermission::create([
                            'role_id' => $item->id , 'permission' => $permission
                        ]);
            }}

        }
         
        if($item)
            return redirect()->route('admin.roles')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Role $item)
    {
        $level2['name'] = 'roles';
        $level2['link'] = 'admin.roles';
 
        $role_permissions = RolePermission::role_permissions($item->id)->toArray();
         
        $permissions = Permission::select('section')->groupBy('section')->get();

        return view($this->view.'edit',compact('item','permissions','role_permissions','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        RolePermission::permissions($item)->delete();

        if(Role::find($item)->delete()) 
            return 1;

        return 0;
    }


}
