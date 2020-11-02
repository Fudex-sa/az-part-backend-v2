<?php
namespace App\Helpers;

use Session;
use App\Models\ElectronicRequest;
use App\Models\AvailableModel;
use App\Models\AssignSeller;
use Illuminate\Http\Request;
use App\Helpers\Search;

class ElecEngine
{
 
    protected $search;

    public function __construct()
    {    
        $this->search = new Search();
    }

    public function create_request(Request $request)
    {
        
        $response = 0;

        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
    
        foreach ($request->piece_alt_id as $k=>$piece_alt) {
             
            if (isset($request->photo)) {
                $img = $request->photo[$k];
                $fileName = time() . '.' . $img->getClientOriginalName();
                $img->move(public_path('uploads/cart'), $fileName);    
                
                $data['photo'] = $fileName;
            }

            $data['piece_alt_id'] = $piece_alt;
            $data['qty'] = $request->qty[$k];           
            $data['notes'] = $request->notes[$k];
            $data['color'] = $request->color[$k];

            $item = ElectronicRequest::create($data);
            if($item) {
                $this->assign_sellers($item->id);

                $response = 1;
            }

        }

        if($response == 1) return true; else return false;

    }
    

    // public function match_sellers()
    // {
    //     $brand = $this->search->search_res('brand');
    //     $model = $this->search->search_res('model');
    //     $year = $this->search->search_res('year');
    //     $city = $this->search->search_res('city');
    //     $region = $this->search->search_res('region');
 
    //     $city_items = AvailableModel::matchOrder($brand,$model,$year)
    //                             ->with('seller')
    //                             ->whereHas('seller',function($q) use ($city){
    //                                 $q->where('city_id',$city);
    //                             });                                
       

    //     if($city_items->count() > 0){
    //         $response['found_result'] = 1; //--- Case found 
    //         $response['items'] = $city_items->get();
    //     }else{

    //         $region_items = AvailableModel::matchOrder($brand,$model,$year)
    //                             ->with('seller')
    //                             ->whereHas('seller',function($q) use ($region){
    //                                 $q->where('region_id',$region);
    //                             }); 

            
    //         if($region_items->count() > 0) {
                    
    //             $response['found_result'] = 2; // ---- Case found in same region
    //             $response['items'] = $region_items->get();

    //         }else {
    //             $response['found_result'] = 0; // --- Case not found
    //             $response['items'] = null;
    //         }
    //     }
 
    //     // $response['city_items'] = $city_items->get();
    //     // $response['region_items'] = $region_items->get();
    //     return $response;

    // }

    public function matched_sellers()
    {
        $brand = $this->search->search_res('brand');
        $model = $this->search->search_res('model');
        $year = $this->search->search_res('year');
        $city = $this->search->search_res('city');
        $region = $this->search->search_res('region');

        $items = AvailableModel::matchOrder($brand,$model,$year)
                        ->with('seller')
                        ->whereHas('seller',function($q) use ($city){
                            $q->where('city_id',$city);
                        })->get();

        return $items;

    }

    public function assign_sellers($req_id)
    {
        $sellers = $this->matched_sellers();
 
        if(count($sellers) > 0){
            foreach($sellers as $seller){

                AssignSeller::create([
                    'seller_id' => $seller->seller->id , 'request_id' => $req_id 
                ]);

            }
        }
        
        return count($sellers);           
    }

    public function send_request(Request $request)
    {
        $response = $this->create_request($request);
         
        return $response;
    }

}