<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarsExport implements FromCollection, WithHeadings
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
        if ($this->type == "antique") {
            return Car::select(
                'id',
                'title',
                'color',
                'kilo_no',
                'price_type',
                'price',
                'notes',
                'created_at',
                'type',
                'views'
            )->where('type', 'antique')->orderby('id', 'desc')->get();
        }
        if ($this->type == "damaged") {
            return Car::select(
                'id',
                'title',
                'color',
                'kilo_no',
                'price_type',
                'price',
                'notes',
                'created_at',
                'type',
                'views'
            )->where('type', 'damaged')->orderby('id', 'desc')->get();
        }

        return Car::all();
    }

    public function headings(): array
    {
        return [
            'Car ID',
            'Title',
            'Color',
            'kilometers',
            'Price Type',
            'Price',
            'Notes',
            'Created At',
            'Car Type',
            'Views'
        ];
    }
}
