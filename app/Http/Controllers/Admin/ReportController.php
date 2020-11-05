<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    
    protected $view = "dashboard.reports.";

    public function all()
    {
        $items = Report::orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Report::find($item)->delete()) 
            return 1;

        return 0;
    }

}
