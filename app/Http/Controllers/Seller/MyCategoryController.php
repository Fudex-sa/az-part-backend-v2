<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SellerCategory;

class MyCategoryController extends Controller
{
    
    protected $view = "sellers.my_categories.";

    public function index()
    {
        $my_categories = true;
 
        $categories = Category::orderby('name_'.my_lang(),'desc')->get();

        $items = SellerCategory::where('user_id',logged_user()->id)->where('user_type',user_type())                                
                                ->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items','my_categories','categories'));
    }
 
    public function edit(SellerCategory $item)
    {
        $my_categories = true;

        $categories = Category::orderby('name_'.my_lang(),'desc')->get();
 
        return view($this->view.'edit',compact('item','categories','my_categories'));

    }

    public function store(Request $request,$id = null){
        
        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
  
        $exits = SellerCategory::where('user_id',logged_user()->id)
                                ->where('user_type',user_type())->where('category_id',$request->category_id)
                                ->first();

        if(! $exits)
            $item = SellerCategory::create($data);
        else 
            $item = null;

        if($item)
            return redirect()->route('seller.my_categories')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.duplicated_row'))->withInput();
         
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(SellerCategory::find($item)->delete()) 
            return 1;

        return 0;
    }
}
