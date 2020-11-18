<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImage;

use App\Http\Resources\CarsResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Api\CommonController;
use Auth;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function damaged(Request $request)
    {
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $items = Car::with('brand')->with('model')->with('city')
                ->where('type', 'damaged')->orderby('id', 'desc')->paginate($limit);
        return response()->json(['status'=>true, 'data' => CarsResource::collection($items)], 200);
    }

    public function antique(Request $request)
    {
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $items = Car::with('brand')->with('model')->with('city')
                ->where('type', 'antique')->with('brand')
                ->with('model')->orderby('id', 'desc')->paginate($limit);
        return response()->json(['status'=>true, 'data' => CarsResource::collection($items)], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id=null)
    {
        $validator = Validator::make(request()->all(), [
          'title' => 'required|max:255',
          'car_type' => 'required|max:255',
          'brand_id' => 'required',
          'model_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 401);
        }

        $item = $request->isMethod('put') ? Car::findOrFail($request->item_id) : new Car;
        $user = Auth::guard('seller')->user();

        $item->title = $request->title;
        $item->user_id = $user->id;
        $item->brand_id = $request->brand_id;
        $item->model_id = $request->model_id;
        $item->year = $request->year;

        $item->color = $request->color;
        $item->kilo_no = $request->kilometers;
        $item->city_id = $request->city_id;
        $item->country_id = $request->country_id;
        $item->region_id = $request->region_id;
        $item->price_type = $request->price_type;
        $item->price = $request->price;
        $item->validatly = $request->validatly;
        $item->publish = $request->publish;
        $item->notes = $request->notes;
        $item->type = $request->car_type;


        $item->save();

        if ($request->hasFile('imgs')) {
            foreach ($request->file('imgs') as $img) {
                $destinationPath = public_path('uploads');
                $name=$img->getClientOriginalName();
                $img->move($destinationPath, $name);
                $carImage = new CarImage;
                $carImage->photo  = $name;
                $carImage->car_id = $item->id;
                $carImage->save();
            }
        }


        return response()->json(['status'=>true, 'data' => new CarsResource($item)], 200);
    }



    public function update(Request $request, $id=null)
    {
        $validator = Validator::make(request()->all(), [
          'title' => 'required|max:255',
          'car_type' => 'required|max:255',
          'brand_id' => 'required',
          'model_id' => 'required',
          'item_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 401);
        }

        $item = Car::findOrFail($request->item_id);
        $user = Auth::guard('seller')->user();

        $item->title = $request->title;
        $item->user_id = $user->id;
        $item->brand_id = $request->brand_id;
        $item->model_id = $request->model_id;
        $item->year = $request->year;

        $item->color = $request->color;
        $item->kilo_no = $request->kilometers;
        $item->city_id = $request->city_id;
        $item->country_id = $request->country_id;
        $item->region_id = $request->region_id;
        $item->price_type = $request->price_type;
        $item->price = $request->price;
        $item->validatly = $request->validatly;
        $item->publish = $request->publish;
        $item->notes = $request->notes;
        $item->type = $request->car_type;


        $item->save();

        if ($request->hasFile('imgs')) {
            $carImages = CarImage::where('car_id', $item->id)->get();
            foreach ($carImages as $key => $carImage) {
                // code...
                $carImage->delete();
            }
            foreach ($request->file('imgs') as $img) {
                $destinationPath = public_path('uploads');
                $name=$img->getClientOriginalName();
                $img->move($destinationPath, $name);
                $carImage = new CarImage;
                $carImage->photo  = $name;
                $carImage->car_id = $item->id;
                $carImage->save();
            }
        }


        return response()->json(['status'=>true, 'data' => new CarsResource($item)], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Car::with('user')->with('brand')->with('model')->with('city')->with('user')
                ->where('id', $id)->first();

        return response()->json(['status'=>true, 'data' => new CarsResource($item)], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Car::findOrFail($id);
        if ($item) {
            $carImages = CarImage::where('car_id', $id)->get();
            foreach ($carImages as $key => $carImage) {
                // code...
                $carImage->delete();
            }
        }

        if ($item->delete()) {
            return response()->json(['status'=>true, 'msg' =>'Successfully Deleted.'], 200);
        }
    }
}
