<?php
use Illuminate\Support\Facades\Route;
use App\Models\Setting; 

function my_lang() {
    return LaravelLocalization::getCurrentLocale();
}

function dashboard($path) {
    return asset('dashboard/'.$path);
}

function site($path) {
    return asset('site/'.$path);
}

function img_path($img_name) {
    return asset('uploads/'.$img_name);
}

function cur_dir() {
    return LaravelLocalization::getCurrentLocaleDirection();
}

function cur_root() {
    return Route::currentRouteName();
}

function pagger(){
    return config()->get('site.pagger');
}

function setting($keyword)
{
    $getValue = Setting::where('keyword',$keyword)->first();
    return $getValue ? $getValue['value_'.my_lang()] : '';
}

