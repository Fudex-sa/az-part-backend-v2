<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestSpare;
use App\Http\Resources\RequestsResource;
use Mobily;

class NotificationController extends Controller
{
    public function requests(Request $request) {
       if($request->limit) $limit = $request->limit; else  $limit = 15;
       if($request->user_id){
        $user_id = $request->user_id;

        $items = RequestSpare::with('brand')->with('model')->with('city')->with('user')->with('piece')
                 ->where('request_type','normal')->with('engineAssignReq')
                ->whereHas('engineAssignReq',function($q) use($user_id,$limit){
                  $q->where('user_id',$user_id)->where('status','!=','pending');
//                          ->where('_read',0);
                })->orderby('id','desc')->paginate($limit);
         return RequestsResource::collection($items);
       }

       else
            return response()->json(['success'=> false,'error' => 'Unauthorized.'], 401);
    }

    public static function sendPushNotification($ids,$title,$body,
    $subjectType='new_request',$actionId=null){

        // ----- $subjectType => 'new_request' , 'car'

        $data = array(
                "to" => $ids,
                "notification" => array(
                    "title" => $title,
                    "body" => $body,
                    'action'  => 'FCM_PLUGIN_ACTIVITY',
                    'vibrate'       => 500,
                    'sound'         => 'car.mp3',
                    'soundName' => 'car.mp3',
//                    "icon" => "icon.png",
                    "click_action" => "http://az.parts"

                ),
                "data" =>  array(
                    'subjectType' => $subjectType,
                    'actionId' => $actionId,
                    'importance' => 'max',
                    'playSound' => true,
                    'priority' => 'max',
                    'sound' => 'car.mp3',
                    'soundName' => 'car.mp3'
                )
            );

        $data_string = json_encode($data);


        $headers = array ( 'Authorization: key=' . env('FIREBASE_SERVER_KEY') , 'Content-Type: application/json' );
        $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        curl_close ($ch);

       // echo $result;

    }

     public static function sendPushNotification2(Request $request){
        $id = $request->id;
        $title = $request->title;
        $body = $request->body;
        $subjectType = $request->subjectType;
        $actionId = $request->actionId;

        $data = array(
                "to" => $id,
                "notification" => array(
                    "title" => $title,
                    "body" => $body,
                    'action'  => 'FCM_PLUGIN_ACTIVITY',
                    'vibrate'       => 500,
                    'sound'         => 'car.mp3',
                    'subjectType' => $subjectType,
//                    "icon" => "icon.png",
                    //"click_action" => "http://az.parts"
                ),
                "data" =>  array(
                    'subjectType' => $subjectType,
                    'actionId' => $actionId
                )
            );

        $data_string = json_encode($data);


        $headers = array ( 'Authorization: key=' . env('FIREBASE_SERVER_KEY') , 'Content-Type: application/json' );
        $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        curl_close ($ch);

        echo $result;

    }


    public function send_sms()
    {
        $response =  Mobily::send('00966582255234', 'Test Msg');
        echo $response;
    }


}
