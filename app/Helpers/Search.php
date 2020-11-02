<?php
namespace App\Helpers;

use Session;
use Illuminate\Http\Request; 
use App\Models\AvailableModel;

class Search
{

    public function save_search(Request $request)
    {
        session()->put('has_request',1);

        session()->put('search',[
            'brand' => $request->brand , 'model' => $request->model ,
            'year' => $request->year , 'country' => $request->country ,
            'region' => $request->region , 'city' => $request->city ,
            'search_type' => $request->search_type 
        ]);
    }

    public function search_url()
    {
        $search = Session::get('search');
        $has_request = Session::get('has_request');

        if( $search && $has_request == 1){
            $brand = $search['brand'];
            $model = $search['model'];
            $year = $search['year'];
            $country = $search['country'];
            $region = $search['region'];
            $city = $search['city'];
            $search_type = $search['search_type'];

            $url = 'parts/search?brand='.$brand.'&model='.$model.'&year='.$year.'&country='.
                        $country.'&region='.$region.'&city='.$city.'&search_type='.$search_type;

            return $url;
        }

    }

    public function search_res($session_name)
    {
        $search = session()->get('search');
        
        return $search[$session_name];
    }

    public function manual_search(Request $request,$limit)
    {
        $city = $request->city;
        $region = $request->region;
 
        $city_items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                                ->with('seller')
                                ->whereHas('seller',function($q) use ($city){
                                    $q->where('city_id',$city);
                                });                                
       

        if($city_items->count() > 0){
            $response['found_result'] = 1; //--- Case found 
            $response['items'] = $city_items->limit($limit)->get();
        }else{

            $region_items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
            ->with('seller')
            ->whereHas('seller',function($q) use ($region){
                $q->where('region_id',$region);
            }); 

            
            if($region_items->count() > 0) {
                    
                $response['found_result'] = 2; // ---- Case found in same region
                $response['items'] = $region_items->limit($limit)->get();

            }else {
                $response['found_result'] = 0; // --- Case not found
                $response['items'] = null;
            }
        }
 
        $response['city_items'] = $city_items->get();
        $response['region_items'] = $region_items->get();
        return $response;
    }


    public function electronic_search(Request $request,$limit)
    {
        $city = $request->city;
        $region = $request->region;
 
        if($limit > 0){

            $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                            ->with('seller')
                            ->whereHas('seller',function($q) use ($city){
                                $q->where('city_id',$city);
                            })                                                
                            ->get();
                            
                if(count($items) > 0){
                    $response['found_result'] = 1; //--- Case found 
                    $response['items'] = $items;

                }else{

                    $items_region = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                            ->with('seller')
                            ->whereHas('seller',function($q) use ($region){
                                $q->where('region_id',$region);
                            })                                         
                            ->get();
                    
                    if(count($items_region) > 0) {
                        
                        $response['found_result'] = 2; // ---- Case found in same region
                        $response['items'] = $items_region;

                    }else $response['found_result'] = 0; // --- Case not found
                }


        }else{
            $response['items'] = null;
            $response['found_result'] = 3; // --- Case not joined any electronic package
            
        }

        return $response;

    }

}