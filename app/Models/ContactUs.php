<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ContactUs extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "contact_us";

    protected $fillable = [
        'name' , 'mobile' , 'email' , 'message' , '_read'
    ];

   

    public function routeNotificationForSlack($notification)
    {
       
       return env('DEFAULT_SLACK_WEBHOOK_ENDPOINT');
    }
}
