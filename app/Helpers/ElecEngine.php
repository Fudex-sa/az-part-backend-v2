<?php
namespace App\Helpers;

use Session;
use App\Models\ElectronicRequest;
use App\Models\AvailableModel;
use App\Models\AssignSeller;
use App\Models\Broker;
use App\Models\EngineJob;
use App\Models\EngineJobBroker;
use App\Models\PackageSubscribe;
use Illuminate\Http\Request;
use App\Helpers\Search;
use App\Helpers\PackageHelp;
use Log;
use App\Models\Seller;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PushNotificationController;

class ElecEngine
{
    protected $search;
    protected $tashlih_no_by_cycle;
    protected $manufacturing_no_by_cycle;


    public function __construct()
    {
        $this->package = new PackageHelp();

        $this->search = new Search();
        $this->tashlih_no_by_cycle = setting('tashlih_no_by_cycle') ? setting('tashlih_no_by_cycle') : 3;

        $this->manufacturing_no_by_cycle = setting('manufacturing_no_by_cycle') ?
                setting('manufacturing_no_by_cycle') : 3;
    }

    public function create_request(Request $request)
    {
        $response = 0;

        $data = $request->except('_token');

        search_session() ?
            $order_type = search_session()['search_type'] : $order_type = order_type();

        $my_subscribe = PackageSubscribe::myPackagesByType($order_type)->first();
        $my_subscribe ? $package_sub_id = $my_subscribe->id : $package_sub_id = 0 ;


        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
        $data['package_sub_id'] = $package_sub_id;

        $photos = array();

        if ($request->hasFile('photo')) {
            foreach ($request->photo as $file) {
                $fileName = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/cart'), $fileName);

                $photos[] = $fileName;
            }
        }

        foreach ($request->piece_alt_id as $k=>$piece_alt) {
            $data['piece_alt_id'] = $piece_alt;
            $data['qty'] = $request->qty[$k];
            $data['notes'] = $request->notes[$k];
            $data['color'] = $request->color[$k];
            $data['photo'] = array_key_exists($k, $photos) ? $photos[$k] : '';

            $item = ElectronicRequest::create($data);
            if ($item) {

                $msg = __('site.new_request_no').' : '.$item->id;
                \Slack::send($msg);

                if ($package_sub_id != 0) {
                    $this->package->update_expired($package_sub_id);
                }

                $req_id = $item->id;

                $this->assign_sellers($req_id);
                $this->run_first_cycle($req_id);
                $response = 1;
            }
        }

        if ($response == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function matched_sellers()
    {
        $brand = $this->search->search_res('brand');
        $model = $this->search->search_res('model');
        $year = $this->search->search_res('year');
        $region = $this->search->search_res('region');

        $items = AvailableModel::matchOrder($brand, $model, $year)
                        ->with('seller')
                        ->whereHas('seller', function ($q) use ($region) {
                            $q->where('region_id', $region)->where('active', 1)
                                ->orderby('vip', 'desc')->orderby('saudi', 'desc');
                        })->get();

        return $items;
    }


    public function assign_sellers($req_id)
    {
        $sellers = $this->matched_sellers();

        if (count($sellers) > 0) {
            foreach ($sellers as $seller) {
                AssignSeller::create([
                    'seller_id' => $seller->seller->id , 'request_id' => $req_id
                ]);

                //$this->send_notification($req_id, $seller->seller->api_token);
            }
        }

        $sellers_count = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0);
        })
                        ->where('request_id', $req_id)->count();

        $this->create_job($req_id, $sellers_count);

        return $sellers_count;
    }

    public function create_job($req_id, $sellers_count)
    {
        EngineJob::create(['request_id' => $req_id , 'sellers_count' => $sellers_count]);
    }

    public function send_request(Request $request)
    {
        $response = $this->create_request($request);

        return $response;
    }

    public function send_notification($req_id, $user_token)
    {
        $myUser = Seller::where('api_token', $user_token)->first();

        $localLang = app()->getLocale();
        $user_lang = $myUser->lang;

        app()->setLocale($user_lang);

        $title = __('site.request_spare');
        $body = __('site.request_spare_no') . $req_id;
 

        PushNotificationController::send((array)$user_token, $title, $body, 'new_request', $req_id);


        app()->setLocale($localLang);
    }

    //--------- Engine -----------
    public function run_first_cycle($req_id)
    {
        $data = ['status_id' => 11 , 'taken' => 1];

        //---------- VIP ------------
        $items = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 1);
        })
                    ->where('request_id', $req_id)->update($data);
        $vipSellers = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 1);
        })
                    ->where('request_id', $req_id)->get();

        foreach ($vipSellers as $item) {
            // code...
            $this->send_notification($req_id, $item->seller->api_token);
        }

        //---------- Tashlih ------------
        $items = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('user_type', 'tashalih')->orderby('saudi', 'desc');
        })
                ->where('request_id', $req_id)
                ->limit($this->tashlih_no_by_cycle)
                ->update($data);

        $tashlihSellers = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('user_type', 'tashalih')->orderby('saudi', 'desc');
        })
                ->where('request_id', $req_id)
                ->limit($this->tashlih_no_by_cycle)->get();

        foreach ($tashlihSellers as $item) {
            // code...
            $this->send_notification($req_id, $item->seller->api_token);
        }


        //---------- Manufacturing ------------
        $items = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('user_type', 'manufacturing')->orderby('saudi', 'desc');
        })
                ->where('request_id', $req_id)
                ->limit($this->manufacturing_no_by_cycle)
                ->update($data);

        $manuSellers = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('user_type', 'manufacturing')->orderby('saudi', 'desc');
        })
                ->where('request_id', $req_id)
                ->limit($this->manufacturing_no_by_cycle)->get();
        foreach ($manuSellers as  $item) {
            // code...
            $this->send_notification($req_id, $item->seller->api_token);
        }
    }

    public function update_to_not_allowed($req_id)
    {
        $items = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('status_id', 11);
        })
                ->where('request_id', $req_id)
                ->update(['status_id' => 12 , 'taken' => 1]);
    }

    public function next_sellers($req_id)
    {
        $data = ['status_id' => 11 ];

        //---------- Tashlih ------------
        $items = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('user_type', 'tashalih')->orderby('saudi', 'desc');
        })
                ->where('request_id', $req_id)
                ->where('status_id', 1)
                ->limit($this->tashlih_no_by_cycle)
                ->update($data);

        //---------- Manufacturing ------------
        $items = AssignSeller::with('seller')->whereHas('seller', function ($q) {
            $q->where('vip', 0)->where('user_type', 'manufacturing')->orderby('saudi', 'desc');
        })
                ->where('request_id', $req_id)
                ->where('status_id', 1)
                ->limit($this->manufacturing_no_by_cycle)
                ->update($data);
    }

    public function run_next_round()
    {
        $reqs = EngineJob::get();

        foreach ($reqs as $req) {
            $req_id = $req->request_id;

            $this->update_to_not_allowed($req_id);
            $this->next_sellers($req_id);
            $this->send_notification($req_id, $req->request->seller['api_token']);
        }
    }

    public function assign_to_brokers($req_id)
    {
        $brokers = Broker::all();

        foreach ($brokers as $broker) {
            AssignSeller::create([
                'seller_id' => $broker->id , 'seller_type' => 'broker' , 'request_id' => $req_id ,
                'status_id' => 11
            ]);
        }
    }

    public function brokers_round()
    {
        $reqs = EngineJob::get();

        foreach ($reqs as $req) {
            $req_id = $req->request_id;

            $assigned_sellers = AssignSeller::with('seller')->whereHas('seller', function ($q) {
                $q->where('vip', 0);
            })
                        ->where('request_id', $req_id)->where('taken', 1)->count();

            if ($assigned_sellers == $req->sellers_count) {
                EngineJobBroker::create(['request_id'=> $req_id]);

                $this->assign_to_brokers($req_id);
                $req->delete();
            }
        }
    }

    public function update_brokers_not_allowed($req_id)
    {
        $items = AssignSeller::where('request_id', $req_id)
                            ->where('status_id', 11)
                            // ->where('seller_type','broker')
                            ->update(['status_id' => 12 , 'taken' => 1]);
    }

    public function assign_to_admin()
    {
        $reqs = EngineJobBroker::get();

        foreach ($reqs as $req) {
            $req_id = $req->request_id;

            ElectronicRequest::where('id', $req_id)->update(['status_id' => 7 ]);

            $this->update_brokers_not_allowed($req_id);

            $req->delete();
        }
    }
}
