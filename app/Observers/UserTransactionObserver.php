<?php

namespace App\Observers;

use App\Models\UserTransaction;

class UserTransactionObserver
{
    /**
     * When a UserTransaction is created calculate the points for the users involved.
     *
     * @param  UserTransaction  $userTransaction
     * @return void
     */
    public function created(UserTransaction $userTransaction)
    {
//        $user = $userTransaction->user;
//        $points = $userTransaction->points;
//        if ($userTransaction->isType('payment')) {
//            $user->awardPoints($points);
//
//            if ($user->parent) {
//                $referer = $user->parent;
//                $refererPoints = calculatePoints($points, $referer);
//                UserTransaction::createReferPayment($referer, $refererPoints);
//                $referer->awardPoints($refererPoints);
//            }
//        } elseif ($userTransaction->isType('redeem')) {
//            $user->awardPoints(-$points);
//        }
    }

    /**
     * Handle the UserTransaction "updated" event.
     *
     * @param  UserTransaction  $userTransaction
     * @return void
     */
    public function updated(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Handle the UserTransaction "deleted" event.
     *
     * @param  UserTransaction  $userTransaction
     * @return void
     */
    public function deleted(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Handle the UserTransaction "restored" event.
     *
     * @param  UserTransaction  $userTransaction
     * @return void
     */
    public function restored(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Handle the UserTransaction "force deleted" event.
     *
     * @param  UserTransaction  $userTransaction
     * @return void
     */
    public function forceDeleted(UserTransaction $userTransaction)
    {
        //
    }
}
