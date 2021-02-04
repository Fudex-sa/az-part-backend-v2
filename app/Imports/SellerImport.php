<?php

namespace App\Imports;

use App\Models\Seller;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use App\Models\DeliveryRegion;
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
         
        foreach ($rows as $row) {
            if ($row[0] != 'رقم المحل') {
               
                $data = [];
                                
                $data['country_id'] = Country::where('name_ar',$row[1])->first()->id;
                $data['region_id'] = Region::where('name_ar',$row[2])->first()->id;
                $data['city_id'] = City::where('name_ar',$row[3])->first()->id;
                $data['tashlih_region'] = DeliveryRegion::where('name_ar',$row[4])->first()->id;
                $data['name'] = $row[5];
                $data['mobile'] = $row[6];
                $data['address'] = $row[7];
                $data['password'] = \Hash::make('123456');               
                $data['active'] = 1;

                $seller = Seller::create($data);
            }
        }
    }
}
