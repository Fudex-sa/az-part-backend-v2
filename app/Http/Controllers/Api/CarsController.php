<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Http\Resources\CarsResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Api\CommonController;

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
                ->where('car_type', 'damaged')->orderby('id', 'desc')->paginate($limit);
        return CarsResource::collection($items);
    }

    public function antique(Request $request)
    {
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $items = Car::with('brand')->with('model')->with('city')
                ->where('car_type', 'antique')->with('brand')
                ->with('model')->orderby('id', 'desc')->paginate($limit);
        return CarsResource::collection($items);
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
        $validator = Validator::make(
            Input::all(),
            array(
                'title' => 'required|max:255',
                'car_type' => 'required|max:255',
                'brand_id' => 'required',
                'model_id' => 'required',
                'auction' => 'required',
                'user_id' => 'required',
                'img' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            )
        );

        if ($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }

        $item = $request->isMethod('put') ? Car::findOrFail($request->item_id) : new Car;

        $item->title = $request->title;
        $item->user_id = $request->user_id;
        $item->category_id = $request->category_id;
        $item->brand_id = $request->brand_id;
        $item->model_id = $request->model_id;
        $item->brand_name = $request->brand_name;
        $item->model_name = $request->model_name;
        $item->year = $request->year;

        $item->color = $request->color;
        $item->kilometers = $request->kilometers;
        $item->city_id = $request->city_id;
        $item->auction = $request->auction;
        $item->price_type = $request->price_type;
        $item->price = $request->price;
        $item->validatly = $request->validatly;
        $item->notes = $request->notes;
        $item->car_type = $request->car_type;
        $item->status = "pending";
        $item->date_auction = $request->date_auction;
        $item->periodic_inspection_validity = $request->periodic_inspection_validity;
        $item->original = $request->original;
        $item->original_manufacture_year = $request->original_manufacture_year;
        $item->replica_manufacture_year = $request->replica_manufacture_year;

        if ($request->hasFile('img')) {
            $fileName =  time().'.'.$request->file('img')->getClientOriginalName();
            $request->file('img')->move(base_path().'/public/uploads/', $fileName);
        } else {
            if ($id) {
                $fileName = $item->img;
            } else {
                $fileName = "";
            }
        }

        $item->img = $fileName;

        $imgs = [];
        if ($request->hasFile('imgs')) {
            foreach ($request->file('imgs') as $img) {
                $imgName =  time().'.'.$img->getClientOriginalName();
                $img->move(base_path().'/public/uploads/', $imgName);
                $imgs[] = $imgName;
            }
        }

        if ($imgs != null) {
            $carImgs = $imgs;
        } else {
            $carImgs = $item->imgs;
        }

        $item->imgs = $carImgs;

        if ($item->save()) {
            return new CarsResource($item);
        }
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
        return new CarsResource($item);
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

        if ($item->delete()) {
            return response()->json(['success'=> true,'error' => 'Successfully Deleted.'], 200);
        }
    }
}
