<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Helpers\HyperPay;
use App\Helpers\OrderHelp;
use App\Helpers\PackageHelp;

class PaymentController extends Controller
{
    protected $view = "site.checkout.";
    
    public $hyperPay;
    public $order;
    public $package;

    public function __construct()
    {
        $this->hyperPay = new HyperPay();
        $this->order = new OrderHelp();
        $this->package = new PackageHelp();
    }

    public function payment_method()
    {

        return view($this->view . 'payment_method');
    }

    public function choose(Request $request)
    {
        
        Session::put('payment_method',$request->method);

        return redirect()->route('payment');

    }

    public function index()
    {
        $payment_method = Session::get('payment_method');

        $checkoutId = $this->hyperPay->getCheckout(total(),$payment_method);

        return view($this->view . 'payment',compact('checkoutId'));
    }

    public function pay_response($checkoutId) {
        $payment_method = Session::get('payment_method');
 
        $responseData = $this->hyperPay->getTransaction($checkoutId,$payment_method);
 
        if($responseData['result']['code'] == env('HYPERPAY_SUCCESS')){
        
            if(payment_type() == 'package')
                $this->package->subscribe();
            else
                $this->order->create_order();
        }
        return view($this->view . 'response', compact('responseData'));
    }
}
