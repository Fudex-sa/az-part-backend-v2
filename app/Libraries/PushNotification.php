<?php

namespace App\Libraries;

use App\Libraries\FirebasePushNotifications\Firebase;
use App\Libraries\FirebasePushNotifications\Push;
class PushNotification
{

//    public $push;
//    public $firebase;
//
//    public function __construct(Push $push, Firebase $firebase)
//    {
//        $this->push = $push;
//        $this->firebase = $firebase;
//    }

    /**
     * @param $message -> message will be sent in notification body.
     * @param $users -> users will receive notification
     * @param $current -> current user for prevent notification created for this user.
     * @param array $additional -> additional data will be send with notification
     * @param bool $single -> check for sending group or send single.
     *
     */

    public function sendPushNotification($regIdsAndroid = [], $title = null, $body = null, $data = [])
    {

        //Type error: Too few arguments to function App\Libraries\PushNotification::__construct(), 0 passed in E:\Saned Projects\_Shaqrady\routes\api.php on line 22 and exactly 2 expected


        $push = new Push();
        $firebase = new Firebase();

        // optional payload
        $dataLoad = array();
        $dataLoad['orderId'] = isset($data['orderId']) ? $data['orderId'] : null;
        $dataLoad['type'] = isset($data['type']) ? $data['type'] : null;
        $dataLoad['count'] = isset($data['count']) ? $data['count'] : null;

        // notification title
        $push->setTitle($title);

        // notification message
        $message = $body;

        $push_type = isset($push_type) ? $push_type : 'multi';
//        $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : 'topic';


        // whether to include to image or not
        //$include_image = isset($_GET['include_image']) ? TRUE : FALSE;
        $include_image = isset($data['image']) ? TRUE : FALSE;


        $push->setMessage($body);

        if ($include_image) {
            $push->setImage($data['image']);
        } else {
            $push->setImage('');
        }


        //$push->setImage('https://api.androidhive.info/images/minion.jpg');
        $push->setIsBackground(TRUE);
        $push->setData($dataLoad);
        $responseAndroid = "";
        if (count($regIdsAndroid) > 0) {
            $json = $push->getPushData();
            $push = $push->getPushNotification();
            $responseAndroid = $firebase->sendMultiple($regIdsAndroid, $push, $json);
        }
        return $responseAndroid;


    }

}