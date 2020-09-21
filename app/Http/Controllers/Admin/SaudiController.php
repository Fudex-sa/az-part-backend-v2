<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broker;
use App\Models\Company;
use App\Models\Seller;
use App\Models\User;

use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;
use DB;

class SaudiController extends Controller
{
    
    protected $view = "dashboard.saudi.";

    public function all()
    {
         
        $brokers = Broker::saudi()->paginate(pagger());
        $companies = Company::saudi()->paginate(pagger());
        $users = User::saudi()->paginate(pagger());
        $sellers = Seller::saudi()->paginate(pagger());

        return view($this->view.'all',compact('brokers','companies','users','sellers'));
    }
 

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = Supervisor::where('id',$id)->first()->password;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  

        if($id) 
            $response = Supervisor::where('id',$id)->update($data);
        
        else $response = Supervisor::create($data);

        if($response)
            return redirect()->route('admin.supervisors')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(Supervisor $item)
    {
        $cols = Schema::getColumnListing('supervisors');

        return view($this->view.'show',compact('item','cols'));

    }
 
}
