<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElectronicEngine;
use App\Models\Cart;

class ElectronicController extends Controller
{
    protected $view = "site.parts.";

    public function create_request(Request $request)
    {
        $response = 0;

        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
   

        foreach ($request->piece_alt_id as $k=>$piece_alt) {
             
            if (isset($request->photo)) {
                $img = $request->photo[$k];
                $fileName = time() . '.' . $img->getClientOriginalName();
                $img->move(public_path('uploads/cart'), $fileName);    
                
                $data['photo'] = $fileName;
            }

            $data['piece_alt_id'] = $piece_alt;
            $data['qty'] = $request->qty[$k];           
            $data['notes'] = $request->notes[$k];
            $data['color'] = $request->color[$k];

            $item = ElectronicEngine::create($data);
            if($item) {
                $response = 1;
            }

        }

        if($response == 1){ 
            return redirect()->route('my_requests')->with('success' , __('site.your_request_sent_successfully'));
        }else
            return back()->with('failed' , __('site.error-happen'))->withInput();

    }
}
