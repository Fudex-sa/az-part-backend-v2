<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
        'brand_id' => $this->brand_id,
        'model_id' => $this->model_id,
        'year' => $this->year,
        'max_price' => $this->max_price,
        'min_price' => $this->min_price,
        'avg_price' => $this->avg_price,
        'piece_id' => $this->piece_id,
        'brand' => [
          'id' => $this->brand->id,
          'name' => $this->brand->$name,
          'logo' => $this->brand->logo,
        ],
        'model' => [
          'id' => $this->model->id,
          'name' => $this->model->$name,
        ],
        'piece' => [
          'id' => $this->piece->id,
          'img' => $this->piece->img,
          'name' => $this->piece->$name,
        ],

      ];
        //return parent::toArray($request);
    }
}
