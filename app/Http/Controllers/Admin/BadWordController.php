<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BadWord;
use App\Http\Requests\Admin\BadWordRequest;

class BadWordController extends Controller
{
    protected $view = "dashboard.badwords.";

    public function all()
    {
        $items = BadWord::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(BadWordRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = BadWord::where('id',$id)->update($data);
        
        else $response = BadWord::create($data);

        if($response)
            return redirect()->route('admin.badwords')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(BadWord $item)
    {
        $level2['name'] = 'badwords';
        $level2['link'] = 'admin.badwords';

        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(BadWord::find($item)->delete()) 
            return 1;

        return 0;
    }
}
