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
        $this->key = "AAAA9VvW7Cs:APA91bHxWg0rNO6mF3x2sanMfbrS9KLcvh6grP_QdY4-uhWtaHJt09Y8C5h4_Fgan3Uzwt-D2o8kkLLURt4xGquoBQXRReXYaOgpbskx53DCmXD9Wk8wbt0Y0B1G36P7yH73phi-goqi";
    }

    public function getKey()
    {
        return $this->key;
    }
}
