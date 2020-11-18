<?php

namespace App\Imports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\ToModel;

class SellerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Seller([
            'name' => $row[0],
            'mobile' => $row[1],
            'password'  =>  \Hash::make($row[2]),
            'user_type' => $row[3],
        ]);
    }
}
