<?php

namespace App\Exports;

use App\Models\CarBidding;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarBiddingExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CarBidding::join('cars', 'cars.id', '=', 'car_bidding.car_id')
                ->join('users', 'users.id', '=', 'car_bidding.user_id')
                ->select('cars.id', 'cars.title', 'cars.car_type', 'users.name', 'car_bidding.comment', 'car_bidding.price')
                ->get();
    }

    public function headings(): array
    {
        return [
            'Car ID',
            'Car Title',
            'Car Type',
            'Bidder Name',
            'Bidder Comment',
            'Bidding Price ',
        ];
    }
}
