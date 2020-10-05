<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    
    public function privacy()
    {
        $item = Page::find(2);

        return view('site.page',compact('item'));
    }

    public function terms()
    {
        $item = Page::find(3);

        return view('site.page',compact('item'));
    }

    public function about_us()
    {
        $item = Page::find(1);

        return view('site.page',compact('item'));
    }

}
