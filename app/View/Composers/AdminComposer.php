<?php

namespace App\View\Composers;

use App\Models\Transaction;
use Illuminate\View\View;

class AdminComposer
{
    /**
     * Add the data to be sent anytime the view is rendered
     */
    public function compose(View $view)
    {
        $transactionCount = Transaction::query()->count();
        $checkInsCounts = Transaction::where('transaction_type_id', TRANSACTION_CHECKIN)->pending()->count();
        $paymentCounts = Transaction::where('transaction_type_id', TRANSACTION_PAYMENT)->pending()->count();
        $googleCounts = Transaction::where('transaction_type_id', TRANSACTION_GOOGLE_REVIEW)->pending()->count();
        $facebookCounts = Transaction::where('transaction_type_id', TRANSACTION_FACEBOOK_REVIEW)->pending()->count();
        $view->with([
            'transactionCount' => $transactionCount,
            'checkInsCounts' => $checkInsCounts,
            'paymentCounts' => $paymentCounts,
            'googleCounts' => $googleCounts,
            'facebookCounts' => $facebookCounts,
        ]);
    }
}
