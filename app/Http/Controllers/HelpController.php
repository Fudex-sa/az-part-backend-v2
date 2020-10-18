<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    
    public function clear_session()
    {
        session()->flush();
            
        return 'success';
        
    }
}
