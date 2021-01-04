<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\ContactUsRequest;
use App\Models\ContactUs;
use App\Notifications\TestNotification;

class ContactUsController extends Controller
{
    
    public function index(ContactUsRequest $request)
    {
        
        $item = ContactUs::create([
            'name' => $request->name , 'email' => $request->email ,
            'mobile' => $request->mobile , 'message' => $request->message
        ]);

        
       $item->notify(new TestNotification());


        // if($item)
        //     return back()->with('success' , __('site.success-save') );
        // else
        //     return back()->with('failed' , __('site.error-happen'))->withInput();
    }
}
