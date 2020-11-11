<?php

namespace App\Http\Controllers\Control;

use App\Models\Car;
use App\Models\CarFavorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CarFavoritesController extends Controller
{
    public function wish_list()
    {
        $items = User::where('id', logged_user()->id)->with('favorites')->first()->favorites;

        return view('control.wishlists.all', compact('items'));
    }


    public function add_wish_list($car_id)
    {
        $exist = CarFavorite::where(['user_id' => logged_user()->id, 'car_id' => $car_id])->first();
        if (empty($exist)) {
            CarFavorite::create(['user_id' => logged_user()->id, 'car_id' => $car_id]);
        }

        return back()->with('success', __('site.added_to_fav'));
    }


    public function remove_wish_list($car_id)
    {
        $exist = CarFavorite::where(['user_id' => logged_user()->id, 'car_id' => $car_id])->first();
        if (!empty($exist)) {
            $exist->delete();
        }

        return back()->with('success', __('site.removed_to_fav'));
    }
}
