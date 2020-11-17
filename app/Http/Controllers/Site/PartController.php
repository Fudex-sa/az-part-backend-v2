<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\PartSearchRequest;
use App\Models\PieceAlt;
use App\Models\Cart;
use App\Models\OrderShipping;
use App\Models\Region;
use App\Models\City;
use App\Models\Stock;
use App\Models\Complain;
use App\Models\Report;
use App\Models\Seller;
use App\Http\Requests\Site\OrderRequest;
use Session;
use App\Helpers\PackageHelp;
use App\Helpers\Search;

class PartController extends Controller
{
    protected $view = "site.parts.";
    public $package;
    protected $search;

    public function __construct()
    {     
        $this->package = new PackageHelp();
        $this->search = new Search();
    }
 
    public function search(PartSearchRequest $request)
    { 

        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        $search_type =  $request->search_type;
        
        $this->search->save_search($request); //--- save search in session

        if($search_type == 'electronic'){

            return $this->electronic_search($request);
            
        }
       

        $sys_limit = setting('manual_search_result');
         
        $this->package->stores_limit($search_type) > 0 ? 

                $limit = $this->package->stores_limit($search_type) : $limit = $sys_limit;
           
        $response = $this->search->manual_search($request,$limit);
 
        $items = $response ? $response['items'] : null;
        $found_result = $response  ? $response['found_result'] : 0;
        $all_items = $response ? $response['all_items'] : null;
         
        return view($this->view.'find_sellers',compact('items','piece_alts','found_result','all_items'));
    }

    public function electronic_search(Request $request)
    {
        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        $response = $this->search->electronic_search($request);

        return view($this->view . 'electronic_search',compact('piece_alts','response'));
    }


    public function addToCart(OrderRequest $request)
    {
        $response = 0;

        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
   

        foreach ($request->piece_alt_id as $k=>$piece_alt) {
             
            if (isset($request->photo)) {
                if(isset($request->photo[$k])) {
                    $img = $request->photo[$k]; 
                    $fileName = time() . '.' . $img->getClientOriginalName();
                    $img->move(public_path('uploads/cart'), $fileName);    
                } else $fileName = "";
                $data['photo'] = $fileName;
            }

            $data['piece_alt_id'] = $piece_alt;
            $data['qty'] = $request->qty[$k];
            $data['price'] = $request->price ? $request->price[$k] : null;
            $data['guarantee'] = $request->guarantee ? $request->guarantee[$k] : null;
            $data['notes'] = $request->notes[$k];
            $data['color'] = $request->color[$k];

            $item = Cart::create($data);
            if($item) {
                $response = 1;

                if($request->type == "manual"){
                    //----------- Add to Stock ------------
                    $piece_id = PieceAlt::where('id',$piece_alt)->first()->piece_id;
                    if($piece_id){
                        $data2 = [
                            'brand_id' => $request->brand_id , 'model_id' => $request->model_id ,
                            'year' => $request->year ,
                            'piece_id' => $piece_id , 'price' => $request->price[$k] , 'seller_id' => $request->seller_id
                        ];
                        Stock::create($data2);
                     }}
            }

        }


        if($response == 1){ 
            return redirect()->route('cart');
        }else
            return back()->with('failed' , __('site.error-happen'))->withInput();
    }

    public function report()
    {
        $complains = Complain::where('active',1)->orderby('name_'.my_lang())->get();

        return view($this->view . 'report',compact('complains'));
    }

    public function send_report(Request $request)
    {
        $data = $request->except("_token");
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();

        $item = Report::create($data);

        if($item)
            return redirect()->route('home')->with('success' , __('site.send_successfully') );
        else
            return back()->with('failed' , __('site.error-happen'))->withInput();
    }

    public function more_pieces()
    {
        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'more_pieces',compact('piece_alts'));
    }

    public function change_search($city)
    {
        $search = search_session();

        $brand = $search['brand'];
        $model = $search['model'];
        $year = $search['year'];
        $country = $search['country'];
        $search_type = $search['search_type'];

        $new_city = City::find($city);

        session()->put('search',[
            'city' => $city , 'region' => $new_city->region_id 
        ]);

        return redirect('parts/search?brand='.$brand.'&model='.$model.'&year='.$year.'&country='.$country.
                        '&region='.$new_city->region_id.'&city='.$city.'&search_type='.$search_type);
        

    }
}
