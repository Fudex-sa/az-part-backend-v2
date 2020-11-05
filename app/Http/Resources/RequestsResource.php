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

      return [
          'id' => $this->id,
          'user_id' => $this->user_id,
          'request_type' => $this->request_type,
          'group_id' => $this->group_id,
          'total' => $this->total,
          'extra_fees' => $this->extra_fees,
          'extra_fees_amount' => $this->extra_fees_amount,
          'brand_id' => $this->brand_id,
          'model_id' => $this->model_id,
          'year' => $this->year,
          'piece_id' => $this->piece_id,
          'img' => $this->img,
          'color' => $this->color,
          'notes' => $this->notes,
          'city_id' => $this->city_id,
          'status' => $this->status,
          'paid' => $this->paid,
          'seen' => $this->seen,
          'accepted_offers' => $this->accepted_offers,
          'let_admin_deal' => $this->let_admin_deal,
          'reason_for_deletion' => $this->reason_for_deletion,
          'deleted_at' => $this->deleted_at,
          'brand' => [
            'id' => $this->brand ? $this->brand->id : '',
            'name' => $this->brand ? $this->brand->name : '',
            'logo' => $this->brand ? $this->brand->logo : '',
          ],
          'model' => [
            'id' => $this->model ? $this->model->id : '',
            'name' => $this->model ? $this->model->name : '',
          ],
          'piece' => [
            'id' => $this->piece ? $this->piece->id : '',
            'img' => $this->piece ? $this->piece->img : '',
            'name' => $this->piece ? $this->piece->name : ''
          ],
          'city' => [
            'id' => $this->city ? $this->city->id : '',
            'name' => $this->city ? $this->city->name : ''
          ]

      ];
          //return parent::toArray($request);
    }
}
