<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UserExport;
use App\Exports\SellerExport;
use App\Exports\SupervisorExport;

use App\Imports\UserImport;
use App\Exports\CarsExport;
use App\Exports\CarBiddingExport;
use App\Exports\RequestsExport;
use App\Exports\StockExport;
use App\Exports\OrderExport;
use Excel;

class ExportExcelController extends Controller
{
    public function users()
    {
        return Excel::download(new UserExport() , 'users.xls');
    }

    public function sellers()
    {
        return Excel::download(new SellerExport() , 'sellers.xls');
    }

    public function supervisors()
    {
        return Excel::download(new SupervisorExport() , 'supervisors.xls');
    }

    public function cars($type = 'damaged')
    {
        return Excel::download(new CarsExport($type) , 'cars.xls');
    }

    public function bidding()
    {
        return Excel::download(new CarBiddingExport() , 'cars_bidding.xls');
    }
    public function requests_normal()
    {
        return Excel::download(new RequestsExport('normal') , 'requests.xls');
    }

    public function requests_vip()
    {
        return Excel::download(new RequestsExport('vip') , 'requests.xls');
    }

    public function stock()
    {
        return Excel::download(new StockExport() , 'stock.xls');
    }

    public function orders()
    {
        return Excel::download(new OrderExport() , 'orders.xls');
    }

}
