<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignSeller;
use App\Http\Resources\RequestsResource;
use App\Http\Resources\RequestsCollection;

use Mobily;
use Auth;

class NotificationController extends Controller
{
    public function requests(Request $request)
    {
        $items = AssignSeller::with('seller')->with('request')
                  ->where('seller_id', Auth::id())->where('status_id', 1)->orderby('id', 'desc')->latest()->paginate(10);


        return response()->json(['status'=>true, 'data' => new RequestsCollection($items)], 200);
    }

    public static function sendPushNotification(
        $ids,
        $title,
        $body,
        $subjectType='new_request',
        $actionId=null
    ) {

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


        $headers = array( 'Authorization: key=' . env('FIREBASE_SERVER_KEY') , 'Content-Type: application/json' );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        curl_close($ch);

        // echo $result;
    }

    public static function sendPushNotification2(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $body = $request->body;
        $subjectType = $request->subjectType;
        $actionId = $request->actionId;

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


        $headers = array( 'Authorization: key=' . env('FIREBASE_SERVER_KEY') , 'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        curl_close($ch);

        echo $result;
    }


    public function send_sms()
    {
        $response =  Mobily::send('00966582255234', 'Test Msg');
        echo $response;
    }
}
