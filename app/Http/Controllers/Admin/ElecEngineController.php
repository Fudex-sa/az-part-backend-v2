<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElectronicRequest;
use App\Models\AssignSeller;
use App\Models\OrderStatus;
use App\Helpers\ElecEngine;

class ElecEngineController extends Controller
{
    
    protected $view = "dashboard.engine.";
    protected $elec_engine;

    public function __construct()
    {
        $this->elec_engine = new ElecEngine();
    }

    public function all()
    {
        $items = ElectronicRequest::with('piece_alt')->with('brand')->with('model')->with('region')
                    ->with('user')
                    ->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all' , compact('items'));
    }

    public function show($id)
    {
        
        $status = OrderStatus::orderby('sort','asc')->get();

        $item = ElectronicRequest::with('piece_alt')->with('brand')->with('model')->with('region')
                                ->with('user')->with('country')
                                ->where('id',$id)
                                ->orderby('id','desc')->first();

        return view($this->view . 'show' , compact('item','status'));
    }

    public function engine($id)
    {
         
        $item = ElectronicRequest::with('piece_alt')->with('brand')->with('model')->with('region')
                                ->with('user')->with('country')
                                ->with('assign_sellers')
                                ->where('id',$id)
                                ->first();

        return view($this->view . 'sellers' , compact('item'));
    }

    public function edit($id)
    {
        $status = OrderStatus::orderby('sort','asc')->get();

        $item = AssignSeller::with('request')->with('seller')->with('broker')
                            ->where('id',$id)->first();

        return view($this->view . 'edit',compact('item','status'));
    }

    public function update(Request $request,$id)
    {
        $item = AssignSeller::where('id',$id)->first();

        $data = $request->only('price','composition','return_possibility','delivery_possibility');

        $update = AssignSeller::where('id',$id)->update($data);

        if($update)
            return redirect()->route('admin.order.engine',$item->request_id)->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();
    }

    public function update_order(Request $request,$id)
    {
        $update = ElectronicRequest::where('id',$id)->update(['status_id' => $request->status_id]);

        if($request->status_id == 7)
            $this->elec_engine->assign_to_admin();

        if($update)
            return redirect()->route('admin.electronic.engine')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();
        
    }

}
