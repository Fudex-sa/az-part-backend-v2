<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Resources\ReportsUsersResources;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct()
    {
    }

    public function collection()
    {
        return Seller::select(
            'id',
            'name',
            'email',
            'mobile',
            'created_at',
            'total_requests',
            'rating'
        )->where('user_role', 'seller_tashalih')->orWhere('user_role', 'seller_manufacturing')
          ->orWhere('user_role', 'mediator')->get();
    }

    public function headings(): array
    {
        return [
            'User ID',
            'User Name',
            'Email',
            'Mobile',
            'Created At',
            'Total Requests',
            'Rating'
        ];
    }
}
