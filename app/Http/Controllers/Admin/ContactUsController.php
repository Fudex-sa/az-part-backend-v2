<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    
    protected $view = "dashboard.contact_us.";

    public function all()
    {
        $items = ContactUs::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }
 
    public function show(ContactUs $item)
    {
        $level2['name'] = 'contact_us';
        $level2['link'] = 'admin.contact_us';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(ContactUs::find($item)->delete()) 
            return 1;

        return 0;
    }

}
