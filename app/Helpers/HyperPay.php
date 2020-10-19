<?php
namespace App\Helpers;

use Session;

class HyperPay
{

    function getCheckout($amount,$payment_method = "visa") {
        
        ($payment_method == "mada") ? $entity_id = env('HYPERPAY_ENTITYID_MADA') :
            $entity_id = env('HYPERPAY_ENTITYID');

        $url = env('HYPERPAY_URL')."/v1/checkouts";
        $data = "entityId=".$entity_id .
            "&amount=" .$amount.
            "&currency=SAR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.env('HYPERPAY_AUTHTOKEN')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseDecode = json_decode($responseData, true);
        $checkoutId = $responseDecode['id'];

        return $checkoutId;

    }


    public function getTransaction($checkoutId,$payment_method = "visa") {
        ($payment_method == "mada") ? $entity_id = env('HYPERPAY_ENTITYID_MADA') :
            $entity_id = env('HYPERPAY_ENTITYID');

        $url = env('HYPERPAY_URL')."/v1/checkouts/".$checkoutId."/payment";
        $url .= "?entityId=".$entity_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.env('HYPERPAY_AUTHTOKEN')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseDecode = json_decode($responseData, true);

        return $responseDecode;
    }


}
