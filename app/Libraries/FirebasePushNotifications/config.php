<?php
/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:14 PM
 */

namespace App\Libraries\FirebasePushNotifications;


class config
{

    public $key;

    public function __construct($key)
    {

        $this->key = "AAAAoFlVMNg:APA91bE-wZewoZMJboPorVZIjYMzB8jY0N1op4NZDWiOIn7N8DZm2W3V2CLHBCx_8EoSpZEIsK_jWU_jxhMwBDQdIGYN1kRrJDrH_BqwgCBLWfMLZOLXJopMpaDpFPrjD8rZQ0cvNHVR";
    }

    public function getKey()
    {
        return $this->key;
    }

}