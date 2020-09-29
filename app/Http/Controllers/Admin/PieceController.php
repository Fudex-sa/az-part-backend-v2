<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PieceRequest;
use App\Models\Piece;
use App\Models\PieceAlt;

class PieceController extends Controller
{
    
    protected $view = "dashboard.pieces.";

    public function all()
    {
        $items = Piece::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function store(PieceRequest $request,$id = null)
    {
         
        $data = $request->except('_token');

         if($id) 
            $response = Piece::where('id',$id)->update($data);
        
        else $response = Piece::create($data);

        if($response)
            return redirect()->route('admin.pieces')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function edit($id)
    {
        $level2['name'] = 'pieces';
        $level2['link'] = 'admin.pieces';

        $item = Piece::with('alts')->whereId($id)->first();
        return view($this->view.'edit',compact('item','level2'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Piece::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function store_alts(Request $request,Piece $piece)
    {
        
        $names_ar = $request->names_ar;
        $names_en = $request->names_en;
        $names_hi = $request->names_hi;
        
        if($names_ar){
         foreach ($names_ar as $k=>$name_ar) {
                  PieceAlt::create([
                    'name_ar' => $name_ar , 'name_en' => $names_en[$k] , 'name_hi' => $names_hi[$k],
                    'piece_id' => $piece->id
                  ]);                  
         }}

         return back()->with('success' , __('site.success-save') );

    }

    public function update_alt(Request $request,PieceAlt $alt){
        
        $update = PieceAlt::where('id',$alt->id)->update([
            'name_ar' => $request->name_ar , 'name_en' => $request->name_en , 'name_hi' => $request->name_hi
        ]);
        
        if($update)
            return back()->with('success' , __('site.success-save') );
    }

    public function delete_alt(Request $request){
        $item = $request->input('id');

        if(PieceAlt::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function search(Request $request)
    {
 
        $items = Piece::where('name_ar','like','%'.$request->search_txt.'%')
                        ->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));

    }
}
