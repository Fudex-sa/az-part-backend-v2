<?php
use Illuminate\Support\Facades\Route;

function my_lang() {
    return LaravelLocalization::getCurrentLocale();
}

function dashboard($path) {
    return asset('dashboard/'.$path);
}

function cur_dir() {
    return LaravelLocalization::getCurrentLocaleDirection();
}

function site($path) {
    return asset('site/'.$path);
}
 
function cur_root() {

    return Route::currentRouteName();

}
