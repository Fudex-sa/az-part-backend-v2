<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
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

        return [
          'id' => $this->id,
          'title' => $this->title,
          'user_id' => $this->user_id,
          'brand_id' => $this->brand_id,
          'model_id' => $this->model_id,
          'year' => $this->year,
          'color' => $this->color,
          'kilometers' => $this->kilo_no,
          'city_id' => $this->city_id,
          'price_type' => $this->price_type,
          'price' => $this->price,
          'validatly' => $this->validatly,
          'publish' => $this->publish,
          'notes' => $this->notes,
          'imgs' => $this->imgs,
          'created_at' => $this->created_at,
          'car_type' => $this->type,
          'brand' => [
            'id' => $this->brand ? $this->brand->id : '',
            'name' => $this->brand ? $this->brand->$name : '',
            'logo' => $this->brand ? $this->brand->logo : ''
          ],
          'model' => [
            'id' => $this->model ? $this->model->id : '',
            'name' => $this->model ? $this->model->$name : '',
            'brand_id' => $this->model ? $this->model->brand_id : ''
          ],
          'city' => [
              'id' => $this->city ? $this->city->id : '',
              'name' => $this->city ? $this->city->$name : '',
              'region_id' => $this->city ? $this->city->region_id : ''
          ],
          'user' => [
              'id' => $this->user ? $this->user->id : '',
              'name' => $this->user ? $this->user->name : '',
              'email' => $this->user ? $this->user->email : '',
              'mobile' => $this->user ? $this->user->mobile : '',
              'user_role' => $this->user ? $this->user->user_role : '',
              'active' => $this->user ? $this->user->active : '',
              'vip' => $this->user ? $this->user->vip : '',
              'total_requests' => $this->user ? $this->user->total_requests : '',
              'logo' => $this->user ? $this->user->logo : '',
              'request_vip' => $this->user ? $this->user->request_vip : '',
          ]
      ];
        //return parent::toArray($request);
    }
}
