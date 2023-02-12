<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionType;

class TransactionController extends Controller
{
    public function index()
    {
        $query = Transaction::query()->filter(request()->except('page'));
        $transactions = $query->with('transactionType', 'user', 'receiver')->orderByDesc('created_at')->paginate(20);

        return view('admin.transaction.index')->with([
            'transactions' => $transactions,
            'types' => TransactionType::all(),
        ]);
    }

    public function accept()
    {
        Transaction::find(request()->id)?->update([
            'status' => TRANSACTION_ACCEPTED,
        ]);

        return response()->json([
            'Accepted successfully!',
        ], 200);
    }

    public function reject()
    {
        Transaction::find(request()->id)->update([
            'status' => TRANSACTION_REJECTED,
        ]);

        return response()->json([
            'Rejected successfully!',
        ]);
    }
}
