<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSeller;
use App\Models\ElectronicRequest;
use App\Http\Requests\Seller\SendOfferRequest;

class RequestsController extends Controller
{
    protected $view = "sellers.requests.";

    public function all()
    {
        $seller_requests = true;

        $items = AssignSeller::with('request')->where('seller_id',logged_user()->id)
                        ->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('seller_requests','items'));
    }

    public function show($id)
    {
        $my_requests = true;

        $item = ElectronicRequest::with('user')->where('id',$id)->first();

        $req_seller = AssignSeller::where('request_id',$item->id)->where('seller_id',logged_user()->id)->first();

        return  view($this->view . 'show',compact('my_requests','item','req_seller'));
    }
 

    public function add_price($id)
    {
        $seller_requests = true;

        $item = AssignSeller::with('request')
                    ->where('id',$id)->first();

        return view($this->view . 'add_offer',compact('seller_requests','item'));
    }

    public function send_price(SendOfferRequest $request,$id)
    {
        $item = AssignSeller::where('id',$id)->update([
            'price' => $request->price , 'composition' => $request->composition , 'status_id' => 10 ,
            'return_possibility' => $request->return_possibility , 'delivery_possibility' => $request->delivery_possibility,
            'guarantee' => $request->guarantee , 'notes' => $request->notes
        ]);

        if($item)
            return redirect()->route('seller.requests')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();
    }

    public function not_available(Request $request)
    {
        $id = $request->input('id');

        if(AssignSeller::where('id',$id)->update(['status_id' => 3]))
            return 1;

        return 0;

    }
 
}
