<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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

      return [
          'id' => $this->id,
          'region_id' => $this->region_id,
          'name' => $this->name,
          'active' => $this->active
      ];
      //  return parent::toArray($request);
    }
}
