<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Resources\ReportsUsersResources;
use App\Models\Order;

class OrderExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::select(
            'id',
            'type',
            'payment_method',
            'user_id',
            'sub_total',
            'delivery_price',
            'taxs',
            'coupon_value',
            'total',
            'remaining_cost',
            'created_at'
        ) 
        // ->with(array('user'=>function($query){
        //     $query->select('name');
        // }))
        ->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Type',
            'Payment Method',
            'User',
            'Sub Total',
            'Delivery Price',
            'Taxs',
            'Coupon Value',
            'Total',
            'Remaining Cost',
            'Created At',            
        ];
    }
}
