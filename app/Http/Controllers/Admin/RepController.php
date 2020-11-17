<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rep;
use App\Models\RepPrice;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Region;
use App\Models\City;
use App\Models\Bank;
use App\Models\DeliveryRegion;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\UserRequest;

class RepController extends Controller
{
    
    protected $view = "dashboard.reps.";

    public function all()
    {
        $items = Rep::with('rep_roles')->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        $cols = Schema::getColumnListing('reps');
        $roles = Role::orderby('id','desc')->get();
        $banks = Bank::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view.'create',compact('cols','roles','banks'));
    }

    public function store(UserRequest $request,$id = null)
    {
         
        $data = $request->except('_token','api_token','role_id','country_id','region_id');

        $request->password ? $data['password'] = bcrypt($request->password) : 
            $data['password'] = Rep::where('id',$id)->first()->password;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  
 
        if($id){ 
            $item = Rep::where('id',$id)->update($data);

            UserRole::roles($id,'rep')->delete();

            if($request->role_id){
                foreach($request->role_id as $role){
                    UserRole::create([
                            'role_id' => $role , 'user_id' => $id , 'type' => 'rep'
                    ]);
            }}
        }
        else{
            $item = Rep::create($data);
            
            UserRole::roles($item->id,'rep')->delete();

            if($request->role_id){
                foreach($request->role_id as $role){
                    UserRole::create([
                            'role_id' => $role , 'user_id' => $item->id , 'type' => 'rep'
                    ]);
            }}
        } 

        if($item)
            return redirect()->route('admin.reps')->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function show(Rep $item)
    {
        
        $cols = Schema::getColumnListing('reps');
        $level2['name'] = 'reps';
        $level2['link'] = 'admin.reps';

        $roles = Role::orderby('id','desc')->get();
        $banks = Bank::orderby('name_'.my_lang(),'desc')->get();

        $rep_rols = UserRole::user_roles($item->id,'rep')->toArray();

        if($item->city){
            $myCities = City::regions($item->city['region_id'])->get();
            $my_regions = Region::where('country_id',$item->city->region['country_id'])->orderby('name_ar','desc')->get();
        }            
        else {
            $myCities = null;
            $my_regions = null;
        }

        $myPrices = RepPrice::myCities($item->id)->get();        

        $delivery_regions = DeliveryRegion::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view.'show',compact('item','cols','roles','level2','rep_rols','myCities',
                    'my_regions','banks','myPrices','delivery_regions'));

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Rep::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id');

        $user = Rep::find($item);
        $user->active == 1 ? $active = 0 : $active = 1;
        if($active == 1) $status = 'activated'; else $status = $user->status;

        if( Rep::where('id',$item)->update(['active' => $active , 'status' => $status]) )
            return 1;

        return 0;        
    }

    public function search(Request $request)
    {
         
        if($request->mobile)
            $items = Rep::where('name',$request->mobile)
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->city)
            $items = Rep::where('city_id',$request->city)                     
                            ->where('active',$request->status)                                
                            ->paginate(pagger());

        elseif($request->name && $request->mobile)
            $items = Rep::where('name','like','%'.$request->name.'%')
                                ->where('name',$request->mobile)
                                ->where('active',$request->status)                                
                                ->paginate(pagger());
        

        elseif($request->city && $request->name && $request->mobile)
            $items = Rep::where('city_id',$request->city) 
                                ->where('name',$request->mobile)
                                ->where('name','like','%'.$request->name.'%')
                                ->where('active',$request->status)                                
                                ->paginate(pagger());

        else 
            $items = Rep::where('name','like','%'.$request->name.'%')
                            ->where('active',$request->status)
                            ->paginate(pagger());
         
        return view($this->view.'all',compact('items'));
    }

    public function price_store(Request $request)
    {
        $data = $request->except('_token');
        
        $item = RepPrice::create($data);

        if($item)
            return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();
    }

    public function price_delete(Request $request){
        $item = $request->input('id');

        if(RepPrice::find($item)->delete()) 
            return 1;

        return 0;
    }
}
