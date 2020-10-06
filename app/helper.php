<?php
use Illuminate\Support\Facades\Route;
use App\Models\Setting; 
use App\Models\Social; 
use App\Models\UserRole;
use App\Models\RolePermission;
use App\Models\UserPermission;
use App\Models\Country;
use App\Models\Region;
use App\Models\Supervisor;
use App\Models\Notification;
use Mobily;

if (! function_exists('my_lang')) {
    function my_lang() {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (! function_exists('dashboard')) {
    function dashboard($path) {
        return asset('dashboard/'.$path);
    }
}

if (! function_exists('site')) {
    function site($path) {
        return asset('site/'.$path);
    }
}

if (! function_exists('img_path')) {
    function img_path($img_name) {
        return asset('uploads/'.$img_name);
    }
}

if (! function_exists('cur_dir')) {
    function cur_dir() {
        return LaravelLocalization::getCurrentLocaleDirection();
    }
}

if (! function_exists('cur_root')) {
    function cur_root() {
        return Route::currentRouteName();
    }
}

if (! function_exists('pagger')) {
    function pagger(){
        return config()->get('site.pagger');
    }
}

if (! function_exists('setting')) {
    function setting($keyword)
    {
        $getValue = Setting::where('keyword',$keyword)->first();
        return $getValue ? $getValue['value_'.my_lang()] : '';
    }
}

if (! function_exists('notification')) {
    function notification($keyword)
    {
        $getValue = Notification::where('keyword',$keyword)->first();
        return $getValue ? $getValue['value_'.my_lang()] : '';
    }
}

if (! function_exists('social_links')) {
    function social_links()
    {
        $links = Social::activeLinks()->get();
        return $links;
    }
}

if (! function_exists('has_permission')) {
    function has_permission($permission)
    {     
        if(auth()->guard('admin')->user()->user_type == 'admin')
            return true;


        $user_roles = UserRole::roles(auth()->guard('admin')->user()->id,'supervisor')->get();
        foreach($user_roles as $user_role){         
            if(  RolePermission::role_permissions($user_role->role_id)->contains($permission) )
            
                return true;         
        }

        if(  UserPermission::user_permissions(auth()->guard('admin')->user()->id,'supervisor')
                ->contains($permission) )           
                return true; 
    
        return false;               
    }
}

if (! function_exists('countries')) {
    function countries()
    {
        return Country::orderby('name_ar','desc')->get();
    }
}

if (! function_exists('regions')) {
    function regions($country_id)
    {
        return Region::where('country_id',$country_id)->orderby('name_ar','desc')->get();
    }
}


if (! function_exists('supervisors_by_month')) {
    function supervisors_by_month($month)
    {
        $items = Supervisor::selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
                            ->whereMonth('created_at', $month)
                            ->groupBy('year', 'month')
                            ->first();

        return $items ? $items->count : 0;
    }
}
 
if (! function_exists('send_sms')) {
    function send_sms($numbers,$message)
    {
        // $numbers = array('966555555555','966545555555','966565555555');        
        Mobily::send($numbers, $message);
    }
}








