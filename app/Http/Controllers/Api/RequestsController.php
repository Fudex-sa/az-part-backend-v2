<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignSeller;
use App\Http\Resources\RequestsResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\RequestOfferResource;
use Auth;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function myRequests(Request $request)
    {
        $items = AssignSeller::with('seller')->with('request')
                    ->where('seller_id', Auth::id())->where('status_id', 11)->orderby('id', 'desc')->latest()->get();


        return response()->json(['status'=>true, 'data' => RequestsResource::collection($items)], 200);
    }

    public function sendOffer(Request $request, $id=null)
    {
        $validator = Validator::make(request()->all(), [
          'price' => 'required',
          'delivery_possibility' => 'required|numeric',
          'composition' => 'required|numeric',
          'return_possibility' => 'required|numeric',
          'item_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 401);
        }

        $item = AssignSeller::findOrFail($request->item_id);
        if ($item) {
            $item->price = $request->price;
            $item->delivery_possibility = $request->delivery_possibility;
            $item->composition = $request->composition;
            $item->return_possibility = $request->return_possibility;
            $item->status_id = 10;
            $item->save();

            return response()->json(['status'=>true, 'data' => new RequestsResource($item)], 200);
        }
        return response()->json(['status'=>false, 'msg' => 'Item Not Found!'], 401);
    }
}
