<?php

namespace App\Exports;

use App\Http\Resources\RequestsResource;
use App\Models\RequestSpare;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class RequestsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function collection()
    {
        app()->setLocale('ar');

        if ($this->type == "normal") {
            $items = RequestSpare::where('request_type', 'normal')->orderby('id', 'desc')->get();
            return RequestsResource::collection($items);
        }
//            return DB::table('request_spares as rs')
//                ->join('brands', 'rs.brand_id', '=', 'brands.id')
//                ->leftJoin('car_models as models', 'rs.model_id', '=', 'models.id')
//                ->join('pieces', 'rs.piece_id', '=', 'pieces.id')
//                ->where('rs.request_type','normal')
//                ->select('brands.name','models.name','rs.year','pieces.name')->get();
//
        ////                ->select('rs.id','rs.request_type','rs.extra_fees_amount', 'brands.name','models.name',
        ////                'rs.year','pieces.name','rs.color','rs.notes','rs.city_id','rs.status','rs.created_at','rs.accepted_offers')->get();



        elseif ($this->type == "special") {
            return RequestSpare::select(
                'id',
                'request_type',
                'extra_fees_amount',
                'brand_id',
                'model_id',
                'year',
                'piece_id',
                'color',
                'notes',
                'city_id',
                'status',
                'created_at',
                'accepted_offers'
            )
                ->where('request_type', 'vip')->get();
        } elseif ($this->type == "admin") {
            return RequestSpare::select(
                'id',
                'request_type',
                'extra_fees_amount',
                'brand_id',
                'model_id',
                'year',
                'piece_id',
                'color',
                'notes',
                'city_id',
                'status',
                'created_at',
                'accepted_offers'
            )
                ->where('status', 'assign_to_admin')->get();
        } else {
            return RequestSpare::all();
        }
    }

    public function headings(): array
    {
        return [
            'Request ID' ,
            'User' ,
            'Request Type',
            'Group ID' ,
            'Total' ,
            'Extra Fees' ,
            'Extra Fees Amount',
            'Brand',
            'Model',
            'Year' ,
            'Piece',
            'Color',
            'Notes',
            'City' ,
            'Status',
            'Paid' ,

            'Accepted Offers' ,
            'Let Admin Deal' ,
            'Reason For Deletion' ,
            'Deleted At'

        ];
    }
}
