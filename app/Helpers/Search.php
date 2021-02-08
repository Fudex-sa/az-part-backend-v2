<?php
namespace App\Helpers;

use Session;
use Illuminate\Http\Request; 
use App\Models\AvailableModel;
use App\Models\User;
use App\Models\Company;
use App\Models\Seller;
use App\Models\SearchHistory;
// use Cookie;

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

    // public function save_cookies()
    // {        
    //     $min = 1;

    //     $search = session()->get('search');
    //     if($search){ 
    //         foreach($search as $k=>$s){            
    //             Cookie::queue($k, $s, $min);
    //     }}
 
    // }

    // public function delete_cookies()
    // {
    //     $search = Session::get('search');

    //     if(Cookie::get('brand')){
    //         if(Cookie::get('brand') == $search['brand']  &
    //             Cookie::get('model') == $search['model'] &
    //             Cookie::get('year') == $search['year'] &
    //             Cookie::get('country') == $search['country'] &
    //             Cookie::get('region') == $search['region'] &
    //             Cookie::get('city') == $search['city'] &
    //             Cookie::get('search_type') == $search['search_type'] 
    //         ) 

    //         return 1;

    //         else return 0;
    //     }

    //     return 0;
    // }
    
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

    public function save_search_history($brand,$model,$year,$country,$region,$city,$limit)
    {        
        $exists = SearchHistory::match($brand,$model,$year)
                                ->count();
 
        if($exists < 1)
            SearchHistory::create([
                'brand_id' => $brand, 'model_id' => $model,
                'year' => $year , 'country_id' => $country,
                'region_id' => $region , 'city_id' => $city,
                'search_type' => 'manual' , 'limit' => $limit , 'user_id' => logged_user()->id,
                'user_type' => user_type()
            ]);

    }
    public function manual_search(Request $request,$limit)
    {
        $response = array();
 
        $region = $request->region;
         
        $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                                ->with('seller')
                                ->whereHas('seller',function($q) use ($region){
                                    $q->where('region_id',$region)->where('active',1)
                                        ->orderby('saudi','desc')->orderby('vip','desc');
                                });                            

        if($items->count() > 0){
            
            $response['found_result'] = 1; //--- Case found in region             
        } else{
            $response['found_result'] = 0;
        }

        $response['all_items'] = $items->get();
        $response['items'] = $items->limit($limit)->get()->sortByDesc(function($query){
            return $query->seller->vip;
        });;                    
         
        return $response;
    }

    public function electronic_search(Request $request)
    {
        $response = array();
 
        $region = $request->region;
   
        $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                                ->with('seller')
                                ->whereHas('seller',function($q) use ($region){
                                    $q->where('region_id',$region)->where('active',1)
                                        ->orderby('saudi','desc')->orderby('vip','desc');
                                });                            

        if($items->count() > 0)            
            $response['found_result'] = 1; //--- Case found in region             
        
        else
            $response['found_result'] = 0;
        

        return $response;
    }
 

    // public function update_remaining_stores($remaining_stores)
    // {
    //     ($remaining_stores < 0) ? $remaining_stores = 0 : $remaining_stores = $remaining_stores;

    //     $data = ['remaining_stores' => $remaining_stores];
        
    //     if(user_type() == 'company')
    //         Company::where('id',logged_user()->id)->update($data);

    //     if(user_type() == 'seller')
    //         Seller::where('id',logged_user()->id)->update($data);
        
    //     else 
    //         User::where('id',logged_user()->id)->update($data);

    // }


    public function update_expired_history()
    {
        $items = SearchHistory::where('expired',0)->update(['expired'=>1]);
    }

    public function update_limit_history($limit)
    {
        $brand = $this->search_res('brand');
        $model = $this->search_res('model');
        $year = $this->search_res('year');

        $items = SearchHistory::match($brand,$model,$year)
                            ->update(['limit'=>$limit]);
    }
}