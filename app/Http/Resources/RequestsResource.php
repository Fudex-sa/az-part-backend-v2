<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestsResource extends JsonResource
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

        'seller_id' => $this->seller_id,
        'request_id' => $this->request_id,
        'price' => $this->price??0,
        'status' => $this->status_id,
        'status_type' => $this->status_id == 11 ? trans('site.processing') : trans('site.pending'),
        'seller_type' => $this->seller_type == 'seller' ? trans('site.seller') : trans('site.broker'),
        'composition' => $this->composition,
        'return_possibility' => $this->return_possibility,
        'delivery_possibility' => $this->delivery_possibility,
        'notes' => $this->notes,
        'guarantee' => $this->guarantee,
        'created_at' => $this->created_at,

        'brand' => [
          'id' => $this->request->brand ? $this->request->brand->id : '',
          'name' => $this->request->brand ? $this->request->brand->$name : '',
          'logo' => $this->request->brand ? $this->request->brand->logo : ''
        ],
        'model' => [
          'id' => $this->request->model ? $this->request->model->id : '',
          'name' => $this->request->model ? $this->request->model->$name : '',
          'brand_id' => $this->request->model ? $this->request->model->brand_id : ''
        ],
        'city' => [
            'id' => $this->request->city ? $this->request->city->id : '',
            'name' => $this->request->city ? $this->request->city->$name : '',
            'region_id' => $this->request->city ? $this->request->city->region_id : ''
        ],

    ];
    }
}
