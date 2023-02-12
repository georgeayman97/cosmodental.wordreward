<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use App\Services\UserService;

class PointsController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function addPoints(User $user)
    {
        $points = calculatePoints(request()->amount_paid, $user);
        Transaction::createPayment($user, $points);
        $userTitle = "Thank You ".$user->name;
        $userMsg = "You have received ".$points . "point From Your Payment";
        $user->sendNotification($user->device_token,$userTitle,$userMsg);
        $user->notifications_count++;
        $user->save();
        Notification::create([
            'user_id'=>$user->id,
            'title'=>$userTitle,
            'description'=>$userMsg,
            'status'=>'unread',
        ]);
        return redirect()->route('user.index')
            ->with('success', trans('User Points Added'));
    }

    public function redeemPoints(User $user)
    {
        $points = request()->points;
        if (! $user->hasEnoughPoints($points)) {
            return redirect()->route('user.index')
                ->with(['msg' => 'User Does Not Have Enough Points']);
        }

        Transaction::createRedeem($user, $points);
        $userTitle = "Thank You ".$user->name;
        $userMsg = $points . " point Redeemed From Your Account";
        $user->sendNotification($user->device_token,$userTitle,$userMsg);
        $user->notifications_count++;
        $user->save();
        Notification::create([
            'user_id'=>$user->id,
            'title'=>$userTitle,
            'description'=>$userMsg,
            'status'=>'unread',
        ]);
        return redirect()->route('user.index')
            ->with(['success' => 'User Points Redeemed']);
    }
}
