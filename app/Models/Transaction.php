<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFilter;

    protected $guarded = [];

    protected $appends = ['name'];

    public function transactionType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function referer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
        return $this->transactionType->name;
    }

    public static function scopePending(Builder $query): Builder
    {
        return $query->where('status', TRANSACTION_PENDING);
    }

    public static function scopePayment(Builder $query): Builder
    {
        return $query->where('transaction_type_id', TRANSACTION_PAYMENT);
    }

    public static function createPayment($user, int $points)
    {
        return self::create([
            'user_id' => $user->id,
            'transaction_type_id' => TRANSACTION_PAYMENT,
            'referer_id' => $user->parent?->id,
            'points' => $points,
            'status' => TRANSACTION_ACCEPTED,
        ]);
    }

    public static function createReferPayment($user, int $points)
    {
        return self::create([
            'user_id' => $user->id,
            'transaction_type_id' => TRANSACTION_REFER_PAYMENT,
            'points' => $points,
            'status' => TRANSACTION_ACCEPTED,
        ]);
    }

    public static function createRedeem(User $user, int $points)
    {
        return self::create([
            'user_id' => $user->id,
            'transaction_type_id' => TRANSACTION_REDEEM,
            'points' => $points,
            'status' => TRANSACTION_ACCEPTED,
        ]);
    }

    public static function createTransfer(User $sender, User $receiver, int $points)
    {
        if (! $sender->hasEnoughPoints($points)) {
            return false;
        }

        return self::create([
            'user_id' => $sender->id,
            'transaction_type_id' => TRANSACTION_TRANSFER,
            'receiver_id' => $receiver->id,
            'points' => $points,
            'status' => TRANSACTION_ACCEPTED,
        ]);
    }

    public function isType($type): bool
    {
        $type = constant('TRANSACTION_'.strtoupper($type));
        if ($this->transaction_type_id == $type) {
            return true;
        }

        return false;
    }

    public function getStatusNameAttribute()
    {
        if ($this->status == TRANSACTION_PENDING) {
            return 'pending';
        }
        if ($this->status == TRANSACTION_ACCEPTED) {
            return 'accepted';
        }
        if ($this->status == TRANSACTION_REJECTED) {
            return 'rejected';
        }
        if ($this->status == TRANSACTION_PROCESSED) {
            return 'processed';
        }
    }
}
