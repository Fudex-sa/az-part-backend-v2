<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;

class UsersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row[0] != 'name') {
                $data = [];
                $data['name'] = $row[0];
                $data['mobile'] = $row[1];
                $data['password'] = \Hash::make($row[2]);                
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
                
                $item = User::create($data);
            }
        }

    }
}
