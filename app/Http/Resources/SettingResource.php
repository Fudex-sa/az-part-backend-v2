<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
        $name = 'value_'.$lang;
        return [
          'value' => $this->$name,
      ];
    }
}
