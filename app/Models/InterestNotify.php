<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class InterestNotify extends Model
{
    protected $table = 'interest_notifies';
    protected $fillable = ['car_id', 'user_interest_id', 'seen'];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function user_interest()
    {
        return $this->belongsTo(UserInterest::class);
    }
}
