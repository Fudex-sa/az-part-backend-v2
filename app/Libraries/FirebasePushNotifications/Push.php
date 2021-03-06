<?php
/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:17 PM
 */

namespace App\Libraries\FirebasePushNotifications;

class Push
{
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;

    public function __construct()
    {
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setImage($imageUrl)
    {
        $this->image = $imageUrl;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setIsBackground($is_background)
    {
        $this->is_background = $is_background;
    }

    public function getPushData()
    {
        $res = array();
        $res['title'] = $this->title;
        $res['body'] = $this->message;
        $res['data'] = $this->data;
        $res['timestamp'] = date('Y-m-d G:i:s');

        return $res;
    }


    public function getPushNotification()
    {
        $res = array();
        $res['title'] = $this->title;
        $res['body'] = $this->message;
        $res['data'] = $this->data;
        $res['timestamp'] = date('Y-m-d G:i:s');
        $res['sound'] = 'car.mp3';
        $res['click_action'] = $this->data['actionId'];
        return $res;
    }
}
