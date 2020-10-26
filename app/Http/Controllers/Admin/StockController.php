<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Piece;
use DB;

class StockController extends Controller
{

    protected $view = "dashboard.stock.";

    public function all()
    {
        $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                        DB::raw('min(price) as min_price'),
                        DB::raw('avg(price) as avg_price'),
                        DB::raw('count(price) as count_price')
                        )
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id','desc')
                        ->paginate(pagger());

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        $pieces = Piece::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'all',compact('items','brands','pieces'));

    }

    public function show(Request $request)
    {
        $items = Stock::where('brand_id',$request->brand)
                        ->where('model_id',$request->model)
                        ->where('year',$request->year)
                        ->where('piece_id',$request->piece)
                        ->orderby('id','desc')
                        ->get();

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        $pieces = Piece::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'show',compact('items','brands','pieces'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Stock::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function store(Request $request,$id = null)
    {
         
        $data = $request->except('_token');
        $data['seller_id'] = 0;

         if($id) 
            $response = Stock::where('id',$id)->update($data);
        
        else $response = Stock::create($data);

        if($response)
            return redirect()->route('admin.stocks')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }
}
