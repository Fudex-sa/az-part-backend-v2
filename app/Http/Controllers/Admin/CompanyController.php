<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
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
         
        $data = $request->except('_token','api_token');

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

        return view($this->view.'show',compact('item','cols'));

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

}
