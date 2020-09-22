<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\UserRole;
use App\Models\Role;
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
        $cols = Schema::getColumnListing('supervisors');
        $roles = Role::orderby('id','desc')->get();

        return view($this->view.'create',compact('cols','roles'));
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
        $cols = Schema::getColumnListing('supervisors');
        $roles = Role::orderby('id','desc')->get();

        $supervisor_rols = UserRole::user_roles($item->id,'supervisor')->toArray();

        return view($this->view.'show',compact('item','cols','roles','supervisor_rols'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Supervisor::find($item)->delete()) 
            return 1;

        return 0;
    }


}
