<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Resources\ReportsUsersResources;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct()
    {
    }

    public function collection()
    {
        return User::select(
            'id',
            'name',
            'email',
            'mobile',
            'created_at',
            'available_orders',
            'rating'
        )->get();
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
