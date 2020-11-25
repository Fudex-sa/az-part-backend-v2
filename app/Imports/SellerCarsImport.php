<?php

namespace App\Imports;

use App\Models\AvailableModel;
use App\Models\Brand;
use App\Models\Modell;
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
        foreach ($rows as $row) {
            if ($row[0] != 'user_id') {
                
                $data = [];
                $data['user_id'] = (int)$row[0];
                $data['brand_id'] = Brand::where('name_ar',$row[1])->first()->id;
                $data['model_id'] = Modell::where('name_ar',$row[2])->first()->id;
                $data['year'] = (int)$row[3];

                $seller = AvailableModel::create($data);
              
            }
        }
    }
}
