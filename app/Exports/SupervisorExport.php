<?php

namespace App\Exports;

use App\Models\Supervisor;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Resources\ReportsUsersResources;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupervisorExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct()
    {
    }

    public function collection()
    {
        return Supervisor::select(
            'id',
            'name',
            'email',
            'mobile',
            'created_at',
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
            'Rating'
        ];
    }
}
