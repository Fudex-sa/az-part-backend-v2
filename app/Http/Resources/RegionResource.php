<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
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
          'country_id' => $this->country_id,
          'name' => $this->$name,
          'active' => $this->active
      ];
        //  return parent::toArray($request);
    }
}
