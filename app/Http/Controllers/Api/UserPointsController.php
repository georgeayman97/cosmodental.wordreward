<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserPointsController extends Controller
{
    public function transfer(Request $request)
    {
        $user = auth()->user();

        $receiver = User::where('phone', $request->receiver_number)->first();
        if(!isset($receiver)){
            return Response::json([
                'status'=>'Error',
                'message'=>__('Wrong Number Transfer failed')
            ], 401);
        }
        if($receiver->id == $user->id){
            return Response::json([
                'status'=>'error',
                'message'=>__('Cant send points to Your Number')
            ], 401);
        }
        if (isset($receiver)) {
            if ($user->points < (200 + $request->points)) {
                return Response::json([
                    'success' => 'Error',
                    'message' => 'User Dont have enough points',
                    'user' => $user,
                    'company_whatsapp'=> '+01093014047',
                    'company_phone'=> '+01093014047',
                    'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
                    'membership_level' => $user->userGroup->name,
                ], 401);
            }
            Transaction::createTransfer($user, $receiver, $request->points);
            $userTitle = 'Thank You '.$user->name;
            $userMsg = 'Points sent to '.$receiver->name;
            $user->sendNotification($user->device_token, $userTitle, $userMsg);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id' => $user->id,
                'title' => $userTitle,
                'description' => $userMsg,
                'status' => 'unread',
            ]);
            $receiverTitle = 'Congratulations';
            $receiverMsg = 'You Have received '.$request->points.' Point From '.$user->name.' Successfully';
            $receiver->sendNotification($receiver->device_token, $receiverTitle, $receiverMsg);
            $receiver->notifications_count++;
            $receiver->save();
            Notification::create([
                'user_id' => $receiver->id,
                'title' => $receiverTitle,
                'description' => $receiverMsg,
                'status' => 'unread',
            ]);

            return Response::json([
                'success' => 'Success',
                'message' => 'Transfer Completed to '.$receiver->phone,
                'user' => $user,
                'membership_level' => $user->userGroup->name,
            ], 200);
        } 
    }

    public function userData(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'membership_level' => $user->userGroup->name,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
        ], 200);
    }

    public function sendGoogleReview(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $oldReviews = Transaction::where('user_id',$user->id)->where('transaction_type_id',TRANSACTION_GOOGLE_REVIEW)->where(function ($query) {
            $query->where('status', TRANSACTION_PROCESSED)
                  ->orWhere('status', TRANSACTION_PENDING);
        })->count();
        if($oldReviews == 0){
            Transaction::create([
                'user_id' => $user->id,
                'transaction_type_id' => TRANSACTION_GOOGLE_REVIEW,
                'points' => 100,
                'status' => TRANSACTION_PENDING,
            ]);
        }
        

        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function sendFacebookReview(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $oldReviews = Transaction::where('user_id',$user->id)->where('transaction_type_id',TRANSACTION_FACEBOOK_REVIEW)->where(function ($query) {
            $query->where('status', TRANSACTION_PROCESSED)
                  ->orWhere('status', TRANSACTION_PENDING);
        })->count();
        if($oldReviews == 0){
            Transaction::create([
                'user_id' => $user->id,
                'transaction_type_id' => TRANSACTION_FACEBOOK_REVIEW,
                'points' => 100,
                'status' => TRANSACTION_PENDING,
            ]);
        }
        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function getfacebookinfo(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)->first();
        $userData->facebook_displayName = $request->facebook_displayName;
        $userData->facebook_profilePhoto = $request->facebook_profilePhoto;
        $userData->facebook_status = 'connected';
        $userData->save();

        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function getgoogleinfo(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)->first();
        $userData->google_displayName = $request->google_displayName;
        $userData->google_profilePhoto = $request->google_profilePhoto;
        $userData->google_status = 'connected';
        $userData->save();
        
        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function sendFacebookCheckin(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        Transaction::create([
            'user_id' => $user->id,
            'transaction_type_id' => TRANSACTION_CHECKIN,
            'points' => 50,
            'status' => TRANSACTION_PENDING,
        ]);

        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function connectFacebook(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)->first();
        $userData->facebook_status = 'connected';
        $userData->save();

        return Response::json([
            'success' => 'Success',
            'user' => $userData,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function connectGoogle(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)->first();
        $userData->google_status = 'connected';
        $userData->save();

        return Response::json([
            'success' => 'Success',
            'user' => $userData,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function transactions(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $transactions =
            UserTransaction::with('transaction')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->map(
                fn ($item) => [
                    'name' => $item->transaction->name,
                    'points' => $item->points,
                    'date' => date('d/m/y h:i A', strtotime($item->created_at)),
                ]
            );

        return Response::json([
            'success' => 'Success',
            'transactions' => $transactions,
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function notfications(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)->first();
        $userData->notifications_count = 0;
        $userData->save();
        $notfications =
            Notification::with('user')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->map(
                fn ($item) => ['title' => $item->title, 'message' => $item->description]
            );

        return Response::json([
            'success' => 'Success',
            'notfications' => $notfications,
            'user' => $userData,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }

    public function disableAcc(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $userData = User::where('id', $user->id)->first();
        $userData->status =  User::STATUS_DISABLED;
        $userData->save();

        return Response::json([
            'success' => 'Success',
            'user' => $user,
            'company_whatsapp'=> '+01093014047',
            'company_phone'=> '+01093014047',
            'company_location'=> 'https://goo.gl/maps/9L7bhbrFVgS2bz7z7',
            'membership_level' => $user->userGroup->name,
        ], 200);
    }
}
