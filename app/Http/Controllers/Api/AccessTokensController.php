<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
        $user = User::where('phone', $request->mobile)
            ->first();

        if ($request->mobile == null || $user == null) {
            return Response::json([
                'status' => 'error',
                'message' => __('wrong mobile number or this number is used before'),
            ], 200);
        }

        if ($request->hashedMobile != md5($user->phone)) {
            return Response::json([
                'status' => 'error',
                'message' => __('wrong mobile number'),
            ], 200);
        }

        $token = $user->createToken($request->device_token);
        $user->device_token = $request->device_token;
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        return Response::json([
            'success' => 'success',
            'token' => $token->plainTextToken,
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function update(Request $request)
    {
        if ($request->name == null) {
            return Response::json([
                'status' => 'error',
                'message' => __('Enter Your name'),
            ], 200);
        }
        if ($request->email == null) {
            return Response::json([
                'status' => 'error',
                'message' => __('Enter Your email'),
            ], 200);
        }
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)
            ->first();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $request->photo = 'https://nuweiba.wordreward.net/uploads/'.$filename;
        } else {
            $request->photo = 'https://nuweiba.wordreward.net/uploads/default.png';
        }

        $userData->update([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'gender' => $request->gender,
            'photo' => $request->photo,
        ]);

        return Response::json([
            'success' => 'success',
            'user' => $userData,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }
}
