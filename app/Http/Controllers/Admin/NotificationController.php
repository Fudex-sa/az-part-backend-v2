<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\Admin\NotificationRequest;

class NotificationController extends Controller
{
    
    protected $view = "dashboard.notifications.";

    public function all()
    {
        $items = Notification::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(NotificationRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = Notification::where('id',$id)->update($data);
        
        else $response = Notification::create($data);

        if($response)
            return redirect()->route('admin.notifications')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Notification $item)
    {
        $level2['name'] = 'notifications';
        $level2['link'] = 'admin.notifications';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Notification::find($item)->delete()) 
            return 1;

        return 0;
    }

}
