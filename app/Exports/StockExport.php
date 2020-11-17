<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stock::orderby('id','desc')->get();
    }

    public function headings(): array
    {
        return [
            'Stock ID',
            'Brand',
            'Model',
            'Year',
            'Piece',
            'Created At',
            'Updated At'
        ];
    }

}
