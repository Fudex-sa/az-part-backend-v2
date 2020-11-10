<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function getCheckout()
    {
        $amount = request('amount');
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8acda4c77250f3d701726ecda1eb2b67" .
            "&amount=" .$amount.
            "&currency=SAR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjZGE0Yzc3MjUwZjNkNzAxNzI2ZWNiZDMwZDJiNTl8V05FOGNQeFc4UQ=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseDecode = json_decode($responseData, true);
        //return $responseDecode;
        $checkoutId = $responseDecode['id'];

        return response()->json(['status'=>true, 'msg' => 'successfully created checkout', 'data' => $responseDecode], 200);
        //return $checkoutId;
    }

    public function getTransaction()
    {
        $checkoutId = request('transaction_id');

        $url = "https://test.oppwa.com/v1/checkouts/".$checkoutId."/payment";
        $url .= "?entityId=8acda4c77250f3d701726ecda1eb2b67";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjZGE0Yzc3MjUwZjNkNzAxNzI2ZWNiZDMwZDJiNTl8V05FOGNQeFc4UQ=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseDecode = json_decode($responseData, true);

        //echo $responseData;
        return response()->json(['status'=>true, 'msg' => 'successfully transaction data', 'data' => $responseDecode], 200);
    }
}
