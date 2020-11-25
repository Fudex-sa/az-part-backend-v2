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
        //  dd($rows);
        

        foreach ($rows as $row) {
            if ($row[0] != 'name') {
                $data = [];
                $data['name'] = $row[0];
                $data['mobile'] = $row[1];
                $data['password'] = \Hash::make($row[2]);
                $data['user_type'] = $row[3];
                $data['email'] = $row[4];
                $data['saudi'] = $row[5];
                $data['active'] = $row[6];
                $data['vip'] = $row[7];
                $data['country_id'] = Country::where('name_ar',$row[8])->first()->id;
                $data['region_id'] = Region::where('name_ar',$row[9])->first()->id;
                $data['city_id'] = City::where('name_ar',$row[10])->first()->id;
                $data['phone'] = $row[11];
                $data['available_orders'] = $row[12];
                $data['rating'] = $row[13];
                $data['created_by'] = $row[14];
                $data['tashlih_region'] = DeliveryRegion::where('name_ar',$row[15])->first()->id;

                $seller = Seller::create($data);
            }
        }
    }
}
