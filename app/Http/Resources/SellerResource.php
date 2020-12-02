<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Seller;
use Auth;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language') ? $request->header('Accept-Language') : 'ar';
        app()->setLocale($lang);
        $name = 'name_'.$lang;


        $seller = Auth::guard('seller')->user();
        if ($seller) {
            $success['token'] =  $seller->createToken('MyApp')->accessToken;
        } else {
            $seller = Seller::find(request('user_id'));
            $success['token'] =  $seller->createToken('MyApp')->accessToken;
        }
        //dd($seller);
        return [
      'id' => $seller->id,
      'name' => $seller->name,
      'email' => $seller->email,
      'mobile' => $seller->mobile,
      'saudi' => $seller->saudi,
      'active' => $seller->active,
      'verification_code' => $seller->verification_code,
      'vip' => $seller->vip,
      'country_id' => $seller->country_id,
      'region_id' => $seller->region_id,
      'city_id' => $seller->city_id,
      'city_name' => $seller->city ? $seller->city->$name : '',
      'country_name' => $seller->country ? $seller->country->$name : '',
      'region_name' => $seller->region ? $seller->region->$name : '',
      'address' => $seller->address,
      'lat' => $seller->lat,
      'lng' => $seller->lng,
      'lang' => $seller->lang,
      'last_login' => $seller->last_login,
      'available_orders' => $seller->available_orders,
      'photo' => $seller->photo,
      'rating' => $seller->rating,
      'user_type' => $seller->user_type,
      'created_by' => $seller->created_by,
      'tashlih_region' => $seller->tashlih_region,
      'token'   => 'Bearer ' .$success['token'],


      ];
    }
}
