<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id' , 'request_id' , 'status_id' , 'seller_type' , 'price' , 'composition' ,
        'return_possibility' , 'delivery_possibility' , 'taken' , 'guarantee' , 'notes'
    ];

    public function seller()
    {         
        return $this->belongsTo(Seller::class,'seller_id');        
    }

    public function broker()
    {         
        return $this->belongsTo(Broker::class,'seller_id');        
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class,'status_id');
    }

    public function request()
    {
        return $this->belongsTo(ElectronicRequest::class,'request_id');
    }
 
}
