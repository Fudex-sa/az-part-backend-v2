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
              'id' => $this->seller ? $this->seller->id : '',
              'name' => $this->seller ? $this->seller->name : '',
              'email' => $this->seller ? $this->seller->email : '',
              'mobile' => $this->seller ? $this->seller->mobile : '',
              'user_role' => $this->seller ? $this->seller->seller_role : '',
              'active' => $this->seller ? $this->seller->active : '',
              'vip' => $this->seller ? $this->seller->vip : '',
              'total_requests' => $this->seller ? $this->seller->total_requests : '',
              'logo' => $this->seller ? $this->seller->logo : '',
              'request_vip' => $this->seller ? $this->seller->request_vip : '',
          ]
      ];
        //return parent::toArray($request);
    }
}
