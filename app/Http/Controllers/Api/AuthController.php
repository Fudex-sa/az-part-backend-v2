<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seller;

use App\Http\Resources\UserResource;
use App\Http\Resources\SellerResource;

use Auth;
use Validator;
use File;
use Hash;
use Mail;
use Carbon\Carbon;
use Mobily;

class AuthController extends Controller
{
    public function register()
    {
        $validator = Validator::make(request()->all(), [
        'name' => 'required',
        'mobile' => 'required|unique:sellers,mobile',
        'password' => 'required|confirmed|min:6',
        'password_confirmation' => 'required|min:6',
        'user_type' => 'required',
        'accepted' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 400);
        }

        if (request('accepted') != 1) {
            return response()->json(['status'=> false,'msg' => 'You must accept rules and condtions']);
        }

        $inputs = request()->all();

        $inputs['password'] = bcrypt($inputs['password']);

        if (request()->hasFile('photo')) {
            $inputs['photo'] = uploadImgFromMobile(request('photo'), 'user');
        }

        $user = new Seller($inputs);


        if ($user->save()) {
            if (Auth::guard('seller')->attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
                //dd('aa');
                $user = Auth::guard('seller')->user();
                $user->update(['api_token' => request('mobile_token')]);

                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $user->token = 'Bearer ' .$success['token'];
            }

            $user = collect($user)->except(['created_at', 'updated_at','password']);
            $user = new SellerResource($user);
            return response()->json(['status'=>true,'msg' => 'sign up successfully', 'data' => $user], 200);
        }
        return response()->json(['status'=>false,'msg' => 'Something Wrong', 400]);
    }

    public function login()
    {
        $validator = Validator::make(request()->all(), ['mobile' => 'required', 'password' => 'required']);
        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 400);
        }

        if (Auth::guard('seller')->attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
            $user = Auth::guard('seller')->user();
            //dd($user);
            $user->update(['api_token' => request('mobile_token')]);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user->token = 'Bearer ' .$success['token'];


            $user = collect($user)->except(['created_at', 'updated_at','password']);
            $user = new SellerResource($user);


            return response()->json(['status'=>true, 'data' => $user], 200);
        }
        return response()->json(['status'=>false,'msg' => 'Incorrect email or password', 400]);
    }




    public function edit_profile()
    {
        $validator = Validator::make(request()->all(), [
        'name' => 'required',
        'email' => 'unique:users,email,'.auth()->id(),
        'mobile' => 'unique:users,mobile,'.auth()->id(),
        'photo' => 'nullable|image',
        'address' => 'nullable',
        'lat' => 'nullable',
        'lang' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }
        $data = request()->all();
        if (request()->hasFile('photo')) {
            //$user = Auth::guard('seller')->user();


            $data['photo'] = uploadImgFromMobile(request('photo'), 'user');
        }
        if (request('password')) {
            $data['password'] = bcrypt(request('password'));
        }
        $user = Seller::find(request('user_id'));
        //dd($user);
        if ($user) {
            $user->update($data);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user->token = 'Bearer ' .$success['token'];
            $user = collect($user)->except(['created_at', 'updated_at','password']);
            $user = new SellerResource($user);
            return response()->json(['status' => true, 'data' => $user], 200);
        }
        return response()->json(['status' => false, 'msg' => 'unauthenticated'], 400);
    }

    public function profile()
    {
        $validator = Validator::make(request()->all(), ['user_id' => 'required|numeric']);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }
        $user = Seller::find(request('user_id'));
        if ($user) {
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user->token = 'Bearer ' .$success['token'];
            $user = new SellerResource($user);
            $user = collect($user)->except(['created_at', 'updated_at']);

            return response()->json(['status' => true, 'data' => $user], 200);
        }
        return response()->json(['status' => false, 'msg' => 'user not found'], 400);
    }



    public function changePassword()
    {
        $user = Auth::user();
        $validator = Validator::make(request()->all(), ['old_password' => 'required|min:6', 'new_password' => 'required|min:6', 'confirmation_password' => 'required|min:6']);
        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 400);
        }

        if (request('new_password') !== request('confirmation_password')) {
            return response()->json(['status' => false,'msg' => 'كلمة المرور وتاكيد كلمة المرور غير متطابقان'], 400);
        }

        if (Hash::check(request('old_password'), $user->password)) {
            $user->update(['password' => bcrypt(request('new_password'))]);
            return response()->json(['status' => true,'msg' => 'تم تغيير كلمة المرور بنجاح'], 200);
        }
        return response()->json(['status' => false,'msg' => 'هذا المستخدم غير مسجل بالتطبيق'], 400);
    }

    public function changePhone()
    {
        $user = Auth::user();
        $validator = Validator::make(request()->all(), ['old_phone' => 'required', 'new_phone' => 'required']);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }

        if (Auth::user()->phone != request('new_phone')) {
            while (Seller::where('phone', request('new_phone'))->first()) {
                return response()->json(['status' => false, 'msg' => 'The phone has already been taken.'], 400);
            }
        }



        if (Seller::where('phone', request('old_phone'))->first()) {
            $user->update(['phone' => request('new_phone')]);
            return response()->json(['status' => true, 'msg' => 'Phone was successfully Updated!'], 200);
        }
        return response()->json(['status' => false, 'msg' => 'These credentials do not match our records.'], 409);
    }


    public function sendMobileCode()
    {
        $validator = Validator::make(request()->all(), [
        'mobile' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }


        if (!empty(request('mobile'))) {
            $user = Seller::where('mobile', request('mobile'))->first();
            if ($user) {
                $code = mt_rand(10000, 99999);
                $number = request('mobile');
                $user->update(['verification_code' => $code]);
                $message = 'Az Parts Verification Code';
                send_sms($number, $message);

                return response()->json(['status' => true, 'data' => 'Code is sent to Mobile code','code'=>$code], 200);
            }
            return response()->json(['status' => false, 'msg' => 'user not found'], 400);
        }
    }


    public function sendCode()
    {
        $validator = Validator::make(request()->all(), [
        'email' => 'nullable|email'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }


        if (!empty(request('email'))) {
            $user = Seller::where('email', request('email'))->first();
            if ($user) {
                $code = mt_rand(1000, 9999);
                $user->update(['reset_code' => $code]);




                return response()->json(['status' => true,'code' => $code, 'msg' => 'تم ارسال الكود الي الايميل الخاص بك'], 200);
            }
            return response()->json(['status' => false, 'msg' => 'هذا المستخدم غير موجود'], 400);
        }
    }

    public function checkCode()
    {
        $validator = Validator::make(request()->all(), [
        'mobile' => 'required',
        'code' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }


        $user = Seller::where('mobile', request('mobile'))->first();

        if ($user) {
            if ($user->verification_code == request('code')) {
                return response()->json(['status'=>  true,'msg' => 'Code is correct'], 200);
            }
            return response()->json(['status' => false, 'msg' => 'Code is not correct'], 200);
        }
        return response()->json(['status' => false, 'msg' => 'user not found'], 400);
    }

    public function updatePassword()
    {
        $validator = Validator::make(request()->all(), [
        'mobile' => 'required',
        'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 400);
        }


        $user = Seller::where('mobile', request('mobile'))->first();

        if ($user) {
            $user->update(['password' => bcrypt(request('password'))]);
            return response()->json(['status' => true, 'msg' => 'password changed successfully'], 200);
        }
        return response()->json(['status' => false, 'msg' => 'something wrong'], 400);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('seller')->user();
        if ($user) {
            $user->logout();
        }

        return response()->json(['status' => false, 'msg' => 'User Logout Successfully'], 200);
    }
}
