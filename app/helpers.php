<?php

use Carbon\Carbon;

function calculatePoints($paid, $user = null): int
{
    $percentage = $user?->usergroup->payment_percentage ?? 5;

    return (int) $paid * ($percentage / 100);
}

function transactionTypes($name = null): Illuminate\Support\Collection
{
    return collect([
        'register' => TRANSACTION_REGISTER,
        'payment' => TRANSACTION_PAYMENT,
        'referPayment' => TRANSACTION_REFER_PAYMENT,
        'checkIn' => TRANSACTION_CHECKIN,
        'redeem' => TRANSACTION_REDEEM,
        'transfer' => TRANSACTION_TRANSFER,
        'googleReview' => TRANSACTION_GOOGLE_REVIEW,
        'facebookReview' => TRANSACTION_FACEBOOK_REVIEW,
    ]);
}

function convertDateToEnglish($input): ?Carbon
{
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $english = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    $date = str_replace($arabic, $english, $input);

    return Carbon::make($date);
}
