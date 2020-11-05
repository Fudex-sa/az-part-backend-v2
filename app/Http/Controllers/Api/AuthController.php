<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Auth;
use Validator;
use File;
use Hash;
use Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register()
    {
        $validator = Validator::make(request()->all(), [
        'name' => 'required',
        'email' => 'required|unique:users',
        'mobile' => 'required|unique:users,phone',
        'password' => 'required|min:6',
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

        $user = new User($inputs);


        if ($user->save()) {
            if (Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
                $user = Auth::user();
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $user->token = 'Bearer ' .$success['token'];
            }

            $user = collect($user)->except(['created_at', 'updated_at']);
            $user = new UserResource($user);
            return response()->json(['status'=>true,'msg' => 'sign up successfully', 'data' => $user], 200);
        }
        return response()->json(['status'=>false,'msg' => 'Something Wrong']);
    }

    public function login()
    {
        $validator = Validator::make(request()->all(), ['mobile' => 'required', 'password' => 'required']);
        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 400);
        }

        if (Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
            $user = Auth::user();
            $user->update(['token' => request('mobile_token')]);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user->token = 'Bearer ' .$success['token'];


            $user = collect($user)->except(['created_at', 'updated_at']);
            $user = new UserResource($user);


            return response()->json(['status'=>true, 'data' => $user], 200);
        }
        return response()->json(['status'=>false,'msg' => 'Incorrect email or password']);
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
            if (Auth::user()->photo) {
                File::delete(public_path('/uploads/'.Auth::user()->photo));
            }
            $data['photo'] = uploadImgFromMobile(request('photo'), 'user');
        }
        Auth::user()->update($data);

        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $user->token = 'Bearer ' .$success['token'];
        $user = collect($user)->except(['created_at', 'updated_at']);
        $user = new UserResource($user);
        return response()->json(['status' => true, 'data' => $user], 200);
    }

    public function profile()
    {
        $validator = Validator::make(request()->all(), ['user_id' => 'required|numeric']);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }
        $user = User::find(request('user_id'));
        if ($user) {
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user->token = 'Bearer ' .$success['token'];
            $user = new UserResource($user);
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
            while (User::where('phone', request('new_phone'))->first()) {
                return response()->json(['status' => false, 'msg' => 'The phone has already been taken.'], 400);
            }
        }



        if (User::where('phone', request('old_phone'))->first()) {
            $user->update(['phone' => request('new_phone')]);
            return response()->json(['status' => true, 'msg' => 'Phone was successfully Updated!'], 200);
        }
        return response()->json(['status' => false, 'msg' => 'These credentials do not match our records.'], 409);
    }


    public function sendMobileCode()
    {
        $validator = Validator::make(request()->all(), [
        'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation Error', 'errors' => $validator->errors()->first()], 400);
        }


        if (!empty(request('phone'))) {
            $user = User::where('phone', request('phone'))->first();
            if ($user) {
                $code = mt_rand(1000, 9999);
                $number = request('phone');
                $user->update(['reset_code' => $code]);

                $this->sendMessages($number, 'تطبيق عيادات  كود التفعيل '.$code);


                // Mail::send('layouts.email', ['code' => $code], function ($message) {
                //     $message->from('extra4itapps@gmail.com', 'Tattamn APP');
                //     $message->to(request('email'));
                //     $message->subject('Reset Password');
                // });

                return response()->json(['message' => 'Success', 'data' => 'Code is sent to Mobile code','code'=>$code], 200);
            }
            return response()->json(['message' => 'Failed', 'data' => 'This user is not exists in our credentials'], 400);
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
            $user = User::where('email', request('email'))->first();
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
        'email' => 'nullable|email',
        'code' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 400);
        }


        $user = User::where('email', request('email'))->first();

        if ($user) {
            if ($user->reset_code == request('code')) {
                return response()->json(['status'=>  true,'msg' => 'الكود صحيح'], 200);
            }
            return response()->json(['status' => false, 'msg' => 'الكود غير صحيح'], 400);
        }
        return response()->json(['status' => false, 'msg' => 'هذا المستخدم غير موجود'], 400);
    }

    public function updatePassword()
    {
        $validator = Validator::make(request()->all(), [
        'email' => 'nullable|email',
        'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 400);
        }


        $user = User::where('email', request('email'))->first();




        if ($user) {
            $user->update(['password' => bcrypt(request('password'))]);
            return response()->json(['status' => true, 'msg' => 'تم تغيير كلمة المرور بنجاح'], 200);
        }
        return response()->json(['status' => false, 'msg' => 'حدث خطا ما'], 400);
    }
}
