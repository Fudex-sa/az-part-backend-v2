<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\RatingHelp;

class RateController extends Controller
{
    protected $rate_help;

    public function __construct()
    {
        $this->rate_help = new RatingHelp();
    }

    public function index(Request $request)
    {  

        $response = $this->rate_help->store($request);

        return $response;
    }
}
