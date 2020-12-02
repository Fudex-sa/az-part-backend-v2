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

    public function requestDetails($id)
    {
        //$item = ElectronicRequest::with('user')->where('id', $id)->first();

        $req_seller = AssignSeller::where('id', $id)->first();

        if ($req_seller) {
            return response()->json(['status'=>true, 'data' => new RequestsResource($req_seller)], 200);
        }
        return response()->json(['status' => false, 'msg' => 'request not found'], 400);
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
        $data = request()->all();
        if (! $id) {
            if ($item) {
                $item = AssignSeller::create($data);

                return response()->json(['status'=>true, 'data' => new RequestsResource($item)], 200);
            }
        } else {
            //dd($id);

            $item = AssignSeller::find($id);
            $item->update($data);
            //dd($item);
            return response()->json(['status'=>true, 'data' => new RequestsResource($item)], 200);
        }
        return response()->json(['status'=>false, 'msg' => 'Item Not Found!'], 401);
    }

    public function destroy($id)
    {
        $item = AssignSeller::findOrFail($id);

        if ($item) {
            if ($item->delete()) {
                return response()->json(['status'=> true,'msg' => 'Successfully Deleted.'], 200);
            }
        } else {
            return response()->json(['status'=> false,'msg' => 'Unauthorized.'], 401);
        }
    }
}
