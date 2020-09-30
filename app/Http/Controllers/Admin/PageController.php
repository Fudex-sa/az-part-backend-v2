<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\Admin\PageRequest;

class PageController extends Controller
{
    protected $view = "dashboard.pages.";
 

    public function store(PageRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = Page::where('id',$id)->update($data);
        
        else $response = Page::create($data);

        if($response)
            return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit(Page $item)
    {
        
        return view($this->view.'edit',compact('item'));

    }
 
}
