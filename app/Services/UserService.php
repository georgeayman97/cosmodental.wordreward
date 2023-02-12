<?php

namespace App\Services;

use App\Models\UserTransaction;

class UserService
{
    public function addPoints($user, $points, $transaction_id)
    {
        UserTransaction::create([
            'user_id' => $user->id,
            'points' => $points,
            'transaction_id' => $transaction_id,
        ]);
        $user->addPoints($points);
    }

    public function redeemPoints($user, $points, $transaction_id)
    {
        UserTransaction::create([
            'user_id' => $user->id,
            'points' => -$points,
            'transaction_id' => $transaction_id,
        ]);
        $user->redeemPoints($points);
    }

    public function transferPoints($sender, $receiver, $points, $transaction_id)
    {
        UserTransaction::create([
            'user_id' => $sender->id,
            'points' => -$points,
            'transaction_id' => $transaction_id,
        ]);
        UserTransaction::create([
            'user_id' => $receiver->id,
            'points' => +$points,
            'transaction_id' => $transaction_id,
        ]);
        $sender->decrement('points', $points);
        $receiver->addPoints($points);
    }
}
