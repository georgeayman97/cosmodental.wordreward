<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Transaction;
use App\Services\UserService;

class TransactionObserver
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the Transaction "created" event.
     *
     * @param  Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        if ($transaction->status == TRANSACTION_ACCEPTED) {
            $this->processAccepted($transaction);
        }
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        if ($transaction->status == TRANSACTION_ACCEPTED) {
            $this->processAccepted($transaction);
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }

    /**
     * @param  Transaction  $transaction
     * @return void
     */
    public function processAccepted(Transaction $transaction): void
    {
        $userService = $this->userService;
        $user = $transaction->user;
        $points = $transaction->points;

        if ($transaction->isType('payment')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);
            if ($user->parent) {
                $referer = $user->parent;
                $refererPoints = $points;
                ($refererPoints <= 0) ?: Transaction::createReferPayment($referer, $refererPoints);
				$userTitle = "Thank You ".$referer->name;
				$userMsg = "You have received ".$refererPoints . "point From Your referer Payment";
				$referer->sendNotification($referer->device_token,$userTitle,$userMsg);
				$referer->notifications_count++;
				$referer->save();
				Notification::create([
					'user_id'=>$referer->id,
					'title'=>$userTitle,
					'description'=>$userMsg,
					'status'=>'unread',
				]);
            }
        } elseif ($transaction->isType('redeem')) {
            $userService->redeemPoints($user, $points, $transaction->id);
        } elseif ($transaction->isType('refer_payment')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);
        } elseif ($transaction->isType('transfer')) {
            $receiver = $transaction->receiver;
            $userService->transferPoints($user, $receiver, $points, $transaction->id);
        } elseif ($transaction->isType('checkin')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);

            $userTitle = "Thank You ".$user->name;
            $userMsg = "You have got " . $points . " point From Check In";
            $user->sendNotification($user->device_token,$userTitle,$userMsg);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id'=>$user->id,
                'title'=>$userTitle,
                'description'=>$userMsg,
                'status'=>'unread',
            ]);
        } elseif ($transaction->isType('google_review')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);

            $userTitle = "Thank You ".$user->name;
            $userMsg = "You have got " . $points . " point From Your Google review";
            $user->sendNotification($user->device_token,$userTitle,$userMsg);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id'=>$user->id,
                'title'=>$userTitle,
                'description'=>$userMsg,
                'status'=>'unread',
            ]);
        } elseif ($transaction->isType('facebook_review')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);

            $userTitle = "Thank You ".$user->name;
            $userMsg = "You have got " . $points . " point From Your Facebook review";
            $user->sendNotification($user->device_token,$userTitle,$userMsg);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id'=>$user->id,
                'title'=>$userTitle,
                'description'=>$userMsg,
                'status'=>'unread',
            ]);
        } elseif ($transaction->isType('refer_gift')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);
			
			$userTitle = "Thank You ".$user->name;
            $userMsg = "You have got " . $points . " point From Your registration using referal";
            $user->sendNotification($user->device_token,$userTitle,$userMsg);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id'=>$user->id,
                'title'=>$userTitle,
                'description'=>$userMsg,
                'status'=>'unread',
            ]);
        } elseif ($transaction->isType('register_gift')) {
            $userService->addPoints($user, $points, $transaction->id);
            $user->addLevelPoints($points);
			
        }
        $transaction->updateQuietly(['status' => TRANSACTION_PROCESSED]);
    }
}
