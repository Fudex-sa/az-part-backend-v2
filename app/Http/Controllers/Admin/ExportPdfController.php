<?php

namespace App\Http\Controllers\Admin;

use App\Models\MyBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seller;
use App\Models\Supervisor;

use App\Models\Car;
use App\Models\CarBidding;
use App\Models\RequestSpare;
use App\Models\Stock;
use PDF;

// ini_set('memory_limit','1024M');

class ExportPdfController extends Controller
{
    public function users()
    {
        $data = User::latest()->get();

        $pdf = PDF::loadView('Pdf.users.users', compact('data'));
        return $pdf->download('users.pdf');
    }

    public function supervisors()
    {
        $data = Supervisor::latest()->get();

        $pdf = PDF::loadView('Pdf.users.supervisors', compact('data'));
        return $pdf->download('supervisors.pdf');
    }

    public function sellers()
    {
        $data = Seller::where('user_type', 'manufacturing')->orWhere('user_type', 'tashalih')
            ->get();

        $pdf = PDF::loadView('Pdf.users.sellers', compact('data'));
        return $pdf->download('sellers.pdf');
    }

    public function sellers_brands(User $item)
    {
        $data = MyBrand::with('brand')->with('model')->where('user_id', $item->id)->get();

        $pdf = PDF::loadView('Pdf.sellers_brands', compact('data', 'item'));
        return $pdf->download('sellers_brands.pdf');
    }

    public function cars($type = "damaged")
    {
        if ($type == "antique") {
            $data = Car::where('type', 'antique')->with('city')->with('brand')
                ->with('model')->with('user')->orderby('id', 'desc')->get();
        }
        if ($type == "damaged") {
            $data = Car::where('type', 'damaged')->orderby('id', 'desc')->get();
        }

        $pdf = PDF::loadView('Pdf.cars', compact('data', 'type'));
        return $pdf->download('cars.pdf');
    }

    public function bidding()
    {
        $data = CarBidding::orderby('id', 'desc')->get();

        $pdf = PDF::loadView('Pdf.cars_bidding', compact('data'));
        return $pdf->download('cars_bidding.pdf');
    }

    public function requests_normal()
    {
        $type = "normal";

        $data = RequestSpare::where('request_type', 'normal')->get();

        $pdf = PDF::loadView('Pdf.requests', compact('data', 'type'));

        return $pdf->download('requests.pdf');
    }

    public function requests_vip()
    {
        $type = "vip";

        $data = RequestSpare::where('request_type', 'vip')->get();

        $pdf = PDF::loadView('Pdf.requests', compact('data', 'type'));

        return $pdf->download('requests.pdf');
    }

    public function requests_admin()
    {
        $type = "admin";

        $data = RequestSpare::where('status', 'assign_to_admin')->get();

        $pdf = PDF::loadView('Pdf.requests', compact('data', 'type'));

        return $pdf->download('requests.pdf');
    }

    public function stock()
    {
        $data = Stock::orderby('id', 'desc')->get();

        $pdf = PDF::loadView('Pdf.stock', compact('data'));
        return $pdf->download('stock.pdf');
    }
}
