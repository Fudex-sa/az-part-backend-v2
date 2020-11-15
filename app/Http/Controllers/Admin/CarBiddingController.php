<?php

namespace App\Http\Controllers\Admin;

use App\Models\BadWord;
use App\Models\Car;
use App\Models\CarBidding;
use App\Models\Modell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CarBiddingController extends Controller
{
    protected $view = "dashboard.bidding.";



    public function edit($id)
    {
        $item = CarBidding::find($id);
        return view('Admin.CarBinding.edit', compact('item'));
    }
    public function update(Request $request)
    {
        $car = Car::find($request->id);
        $car->date_auction = $request->date_auction;
        $item =   $car->update();
        if ($item) {
            return back()->with('success', __('site.success-save'));
        } else {
            return back()->with('failed', __('site.error-happen'));
        }
    }
    public function all()
    {
        $items = CarBidding::orderby('id', 'desc')->paginate(15);

        return view($this->view . 'all', compact('items'));
    }

    /**
     * function change status comment to approve
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateStatusApprove($id, $status)
    {
        $carBidding = CarBidding::find($id);

        ($status == 1) ? $status = 1  : $status = 0;
        $item = $carBidding->update([
            'status' => $status,
        ]);

        if ($item) {
            return back()->with('success', __('site.success-save'));
        } else {
            return back()->with('failed', __('site.error-happen'));
        }
    }


    /**
     * function change status comment to reject
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateStatusReject($id, $status)
    {
        $carBidding = CarBidding::find($id);

        ($status == 0) ? $status = 0 : $status = 2;
        $item = $carBidding->update([
            'status' => $status,
        ]);

        if ($item) {
            return back()->with('success', __('site.success-save'));
        } else {
            return back()->with('failed', __('site.error-happen'));
        }
    }


    public function delete(Request $request)
    {
        $item = $request->input('item');

        if (CarBidding::find($item)->delete()) {
            return 1;
        } else {
            return 0;
        }
    }
}
