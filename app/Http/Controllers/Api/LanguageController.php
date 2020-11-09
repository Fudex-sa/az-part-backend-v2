<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Models\Seller;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $validator = Validator::make(request()->all(), [
          'user_id' => 'required',
          'lang' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false,'msg' => $validator->errors()->first()], 401);
        }

        $user = Seller::findOrFail($request->user_id);
        if ($user) {
            $user->lang = $request->lang;
            $user->save();

            return response()->json(['status'=>true, 'msg' => 'Updated Successfully'], 200);
        }

        return response()->json(['status'=>false, 'msg' => 'User Not Found!'], 401);
    }
}
