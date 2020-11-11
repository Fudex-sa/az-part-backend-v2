<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use App\Models\SellerRate;
use App\Models\AssignSeller;
use App\Models\Seller;
use App\Models\Broker;

class RatingHelp
{

    public function store(Request $request)
    {
        $rate = $request->input('rate');
        $item_id = $request->input('item_id');

        $assign_seller = AssignSeller::find($item_id);

        $exists = $this->already_rated($assign_seller);
 
        if($exists > 0)
            return 0;

        else{
            $data = [
                'user_id' => logged_user()->id , 'rate' => $rate ,
                'seller_id' => $assign_seller->seller_id, 'user_type' => $assign_seller->seller_type
            ];

            $item = SellerRate::create($data);

            if($assign_seller->seller_type == 'seller')
                $seller = Seller::where('id',$assign_seller->seller_id)->first();
            else 
                $seller = Broker::where('id',$assign_seller->seller_id)->first();

            $seller->rating = $seller->rating + $rate;
            $seller->save();

            return 1;
        }
    }

    public function already_rated(AssignSeller $seller)
    {
        $count_rate = SellerRate::where('user_id',logged_user()->id)->where('user_type',$seller->seller_type)
                    ->where('seller_id',$seller->seller_id)->count();

        return $count_rate;
    }


}