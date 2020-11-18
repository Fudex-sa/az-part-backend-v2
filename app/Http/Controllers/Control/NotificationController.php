<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InterestNotify;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = InterestNotify::whereHas('user_interest', function ($q) {
            $q->where('user_id', logged_user()->id);
        })->get();
        //dd($notifications);
        return view('control.notifications.index', compact('notifications'));
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
}
