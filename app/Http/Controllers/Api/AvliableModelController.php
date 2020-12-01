<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\AvailableModel;
use App\Http\Requests\Seller\AvailableModelRequest;
use Auth;
use App\Http\Resources\AvailableModelResource;
use Illuminate\Support\Facades\Validator;

class AvliableModelController extends Controller
{
    public function index()
    {
        $avaliable_models = true;

        $items = AvailableModel::userBrands(Auth::id())->orderby('brand_id', 'desc')
                                ->orderby('model_id', 'desc')->paginate(15);

        return response()->json(['status'=>true, 'data' => AvailableModelResource::collection($items)], 200);
    }

    public function show($id)
    {
        $item = AvailableModel::where('id', $id)->with('brand')->with('model')->first();
        if ($item) {
            return response()->json(['status'=>true, 'data' => new AvailableModelResource($item)], 200);
        } else {
            return response()->json(['status'=>false, 'msg' => 'item not found'], 200);
        }
    }

    public function store(Request $request, $id = null)
    {
        $validator = Validator::make(request()->all(), [
        'year' => 'required',
        'brand_id' => 'required',
        'model_id' => 'required',
      ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 401);
        }

        $data = request()->all();
        $data['user_id'] = Auth::id();
        $data['city_id'] = Auth::user()->city_id;

        if (! $id) {
            foreach (request('year') as $year) {
                $data['year'] = $year;

                $item = AvailableModel::create($data);
            }
        } else {
            //dd($id);
            $item = AvailableModel::find($id);
            $item->update($data);
            //dd($item);
        }
        // dd($item);

        return response()->json(['status'=>true, 'data' => new AvailableModelResource($item)], 200);
    }

    public function delete(Request $request)
    {
        $item = $request->input('id');

        if (AvailableModel::find($item)->delete()) {
            return response()->json(['status'=>true, 'msg' => 'item deleted Successfully'], 200);
        }

        return response()->json(['status'=>false, 'msg' => 'item not found'], 200);
    }
}
