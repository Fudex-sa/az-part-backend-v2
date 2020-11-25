<?php

namespace App\Imports;

use App\Models\AvailableModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class SellerCarsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        //  dd($rows);


        foreach ($rows as $row) {
            if ($row[0] != 'user_id') {
                //dd($row);
                $data = [];
                $data['user_id'] = (int)$row[0];
                $data['brand_id'] = (int)$row[1];
                $data['model_id'] = (int)$row[2];
                $data['year'] = (int)$row[3];

                $seller = AvailableModel::create($data);
                //dd($seller);
            }
        }
    }
}
