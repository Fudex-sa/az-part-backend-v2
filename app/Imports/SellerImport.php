<?php

namespace App\Imports;

use App\Models\Seller;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class SellerImport implements ToCollection
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
            if ($row[0] != 'name') {
                $data = [];
                $data['name'] = $row[0];
                $data['mobile'] = $row[1];
                $data['password'] = \Hash::make($row[2]);
                $data['user_type'] = $row[3];

                $seller = Seller::create($data);
            }
        }
    }
}
