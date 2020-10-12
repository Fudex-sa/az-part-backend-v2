<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\PartSearchRequest;
use App\Models\AvailableModel;
use App\Models\PieceAlt;

class PartController extends Controller
{
    protected $view = "site.parts.";

    public function search(PartSearchRequest $request)
    {
        $year = $request->year;

        $items = AvailableModel::matchOrder($request->brand,$request->model)                    
                    ->get();
     
        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view.'find_sellers',compact('items','piece_alts'));
    }

}
