<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class PushNotificationController extends Controller
{
    
    public static function send($tokens,$title,$body,$subjectType='new_request',$actionId)
    {
         
        $push = new  \App\Libraries\PushNotification();
 
        return $push->sendPushNotification($tokens, $title, $body,
                         ['subjectType' => $subjectType, 'actionId' => $actionId]);
      
    }
    
    public function send_api(Request $request)
    {
       $tokens[] = array();
       $tokens = $request->tokens;
        
       $title = $request->title; 
       $body = $request->body; 
       $subjectType = $request->subjectType;
       $actionId = $request->actionId;


        $push = new  \App\Libraries\PushNotification();

      //  $tokens = ["cMdJ6nu1S6iLilde9C1jfV:APA91bE3xNu4k3XYAdMrREg7ZvEvzb2kZ1mRN6MONuY21EL1fB83wW6w0AF1ViGj1d7zxZGvHZXedA6aGBXXECvUxzrXN1k6Wpq5qDV49dZ1UAYp6Vt0PlCw4TFxsS6Ljr9rhPMcqAnB"];
      
        Log::info(     "response".       
            $push->sendPushNotification($tokens, $title, $body,
            ['subjectType' => $subjectType, 'actionId' => $actionId])
        );

        return $push->sendPushNotification($tokens, $title, $body,
                         ['subjectType' => $subjectType, 'actionId' => $actionId]);
      
    }

}
