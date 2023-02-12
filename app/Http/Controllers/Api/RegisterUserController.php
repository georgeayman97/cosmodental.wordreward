<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Response;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\UserTransaction;

class RegisterUserController extends Controller
{
    public function store(Request $request)
    {
		$olduser = User::where('phone',$request->phone)->get();
		if($request->phone == null || $olduser->count() != 0){
			return Response::json([
                        'status'=>'error',
                        'message'=>__('wrong mobile number or this number is used before')
                    ], 200);
		}
		if($request->name == null ){
			return Response::json([
                        'status'=>'error',
                        'message'=>__('please enter your name')
                    ], 200);
		}
		$olduser = User::where('email',$request->email)->get();
		if($request->email == null || $olduser->count() != 0){
			return Response::json([
                        'status'=>'error',
                        'message'=>__('wrong email or this email is used before')
                    ], 200);
		}
		if($request->device_token == null ){
			return Response::json([
                        'status'=>'error',
                        'message'=>__('No device_token')
                    ], 200);
		}
        if ($request->hashedMobile != md5($request->phone)){
            return Response::json([
                        'status'=>'error',
                        'message'=>__('wrong mobile number')
                    ], 200);
        }
		
		
		
        if ($request->referer_code == ''){
            $request->referer_code = "cosmoDental";
        }else{
            $sign =substr($request->referer_code,0,1);
            if($sign == "+"){
                $refNum = substr($request->referer_code,3);
                $request->referer_code = User::where('phone','like',"%{$refNum}%")->pluck('phone')->first();
            }elseif($sign == "0"){
                $refNum = $request->referer_code;
                $request->referer_code = User::where('phone','like',"%{$refNum}%")->pluck('phone')->first();
            }
            $refer_user = User::where('refer_code',$request->referer_code)->orwhere('phone',$request->referer_code)->first();
            if($refer_user == null){
                return Response::json([
                    'status'=>'error',
                    'message'=>__('Cant Find Referal User Please enter Code Or Mobile Number Correctly')
                ], 200);
            }
        }
		
        if($request->hasFile('photo')){
            $file = $request->file('photo'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
           
            $request->photo = 'https://cosmodental.wordreward.net/uploads/'.$filename;
            
        }else{
            $request->photo = 'https://cosmodental.wordreward.net/uploads/default.png';
        }
        $enDate = convertDateToEnglish($request->birthdate);
        $user = User::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $enDate,
            'photo' => $request->photo,
            'gender' => $request->gender,
            'device_token' => $request->device_token,
            'password' => $request->hashedMobile,
            'facebook_review_status'=>0,
            'google_status'=>0,
            'facebook_status'=>0,
            'user_group_level'=>1,
            'role'=>'client',
			'status' => User::STATUS_ACTIVE
        ]);
		$userCode = $user->generateUserCode();
        $user->refer_code = $user->id . $userCode;
		$user->user_code = $user->id . $userCode;
        $user->awardPoints(200);
        $user->sendNotification(
								$user->device_token,
								"Welcome To Cosmo Dental Clinic",
								"Congratulations You have won 200 Points welcome points"
							   );
        $user->notifications_count++;
		Notification::create([
            'user_id'=>$user->id,
            'title'=>"Welcome To Cosmo Dental Clinic",
            'description'=>"Congratulations You have won 200 Points welcome points",
            'status'=>'unread',
        ]);
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_type_id' => TRANSACTION_REGISTER,
            'points' => 200,
            'status' => TRANSACTION_PROCESSED,
        ]);
        UserTransaction::create([
            'user_id' => $user->id,
            'points' => 200,
            'transaction_id' => $transaction->id,
        ]);
        if(isset($refer_user)){
			$user->awardPoints(50);
			$refer_user->awardPoints(100);
            $user->referer_id = $refer_user->id;
			$user->sendNotification(
						$refer_user->device_token,
						"Congratulations you got gift",
						"Congratulations You have won 100 Points from your referal friend ".$user->name
					   );
			$refer_user->notifications_count++;
			Notification::create([
				'user_id'=>$refer_user->id,
				'title'=>"Congratulations you got gift",
				'description'=>"Congratulations You have won 100 Points from your referal friend".$user->name,
				'status'=>'unread',
			]);
            $user->sendNotification(
                $user->device_token,
                "Welcome To Cosmo Dental Clinic",
                "Congratulations You have won 50 Points welcome points from your referal friend"
               );
            $user->notifications_count++;
            Notification::create([
                'user_id'=>$user->id,
                'title'=>"Welcome To Cosmo Dental Clinic",
                'description'=>"Congratulations You have won 50 Points welcome points from your referal friend",
                'status'=>'unread',
            ]);
			$transaction = Transaction::create([
				'user_id' => $refer_user->id,
				'transaction_type_id' => TRANSACTION_REGISTER_GIFT,
				'points' => 100,
				'status' => TRANSACTION_PROCESSED,
			]);
			UserTransaction::create([
				'user_id' => $refer_user->id,
				'points' => 100,
				'transaction_id' => $transaction->id,
			]);
			$transaction = Transaction::create([
				'user_id' => $user->id,
				'transaction_type_id' => TRANSACTION_REFER_GIFT,
				'points' => 50,
				'status' => TRANSACTION_PROCESSED,
			]);
			UserTransaction::create([
				'user_id' => $user->id,
				'points' => 50,
				'transaction_id' => $transaction->id,
			]);
        }
        $user->save();
		event(new Registered($user));
		$token = $user->createToken($request->device_token);
		
        return Response::json([
            'status'=> 'Success',
            'token'=>$token->plainTextToken,
            'user' => $user,
            'company_whatsapp'=> '+01002415182',
            'company_phone'=> '+0572196000',
            'company_location'=> 'https://goo.gl/maps/sodQ1jbdWE4UZbZE7',
            'membership_level'=>$user->userGroup->name,
        ], 200);
    }
}
