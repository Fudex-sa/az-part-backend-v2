<?php

namespace App\Imports;

use App\Models\AvailableModel;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\Seller;
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
            if ($row[0] != 'رقم المحل') {
                
                $data = [];

                $data['user_id'] = (int)$row[0];
                $data['brand_id'] = Brand::where('name_ar',$row[2])->first() ? 
                                Brand::where('name_ar',$row[2])->first()->id : 0;
                $data['model_id'] = Modell::where('name_ar',$row[3])->first() ? 
                            Modell::where('name_ar',$row[3])->first()->id : 0;
                $data['city_id'] = Seller::where('id',$row[0])->first() ? 
                        Seller::where('id',$row[0])->first()->id : 0;
                $data['year'] = (int)$row[4];
                 
                $seller = AvailableModel::create($data);
              
                if($row[5] != null || $row[6] != null || $row[7] != null ||
                    $row[8] != null || $row[9] != null || $row[10] != null ||
                    $row[11] != null || $row[12] != null || $row[13] != null ||
                    $row[14] != null || $row[15] != null || $row[16] != null ||
                    $row[17] != null || $row[18] != null || $row[19] != null ||
                    $row[20] != null || $row[21] != null || $row[22] != null ||
                    $row[23] != null || $row[24] != null || $row[25] != null ||
                    $row[26] != null || $row[27] != null || $row[28] != null ||
                    $row[29] != null || $row[30] != null || $row[31] != null ||
                    $row[32] != null || $row[33] != null || $row[34] != null){

                    $data['user_id'] = (int)$row[0];
                    $data['brand_id'] = Brand::where('name_ar',$row[2])->first() ? 
                                    Brand::where('name_ar',$row[2])->first()->id : 0;
                    $data['model_id'] = Modell::where('name_ar',$row[3])->first() ? 
                                Modell::where('name_ar',$row[3])->first()->id : 0;
                    $data['city_id'] = Seller::where('id',$row[0])->first() ? 
                            Seller::where('id',$row[0])->first()->id : 0;
                    $data['year'] = (int)$row[4];
                     
                    $seller = AvailableModel::create($data);
                }

            }
        }
    }
}
