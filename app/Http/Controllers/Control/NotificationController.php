<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InterestNotify;
use App\Models\AssignSeller;

class NotificationController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $notifications = InterestNotify::whereHas('user_interest', function ($q) {
            $q->where('user_id', logged_user()->id);
        })->get();
        $sellerNotifications = AssignSeller::with('seller')->with('request')
                  ->where('seller_id', logged_user()->id)->where('status_id', 11)->orderby('id', 'desc')->latest()->get();

        //dd($sellerNotifications);
        return view('control.notifications.index', compact('notifications', 'sellerNotifications'));
    }

    public function delete($id)
    {
        $notification = InterestNotify::find($id);
        if ($notification) {
            $notification->delete();


            return back()->with('success', __('site.delete_success'));
        }
        return back()->with('failed', __('site.error-happen'));
    }

    public function deleteSellerNotif($id)
    {
        $notification = AssignSeller::find($id);
        if ($notification) {
            $notification->delete();


            return back()->with('success', __('site.delete_success'));
        }
        return back()->with('failed', __('site.error-happen'));
    }
}
