<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rep;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;

class RepController extends Controller
{
    
    protected $view = "dashboard.reps.";

    public function all()
    {
        $items = Rep::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $cols = Schema::getColumnListing('reps');

        return view($this->view.'create',compact('cols'));
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = Rep::where('id',$id)->first()->password;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  

        if($id) 
            $response = Rep::where('id',$id)->update($data);
        
        else $response = Rep::create($data);

        if($response)
            return redirect()->route('admin.reps')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(Rep $item)
    {
        $cols = Schema::getColumnListing('reps');

        return view($this->view.'show',compact('item','cols'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Rep::find($item)->delete()) 
            return 1;

        return 0;
    }

}
