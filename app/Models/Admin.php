<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFilter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFilter;
    
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';

    const ROLE_ADMIN = 0;
    const ROLE_RESEPTIONIST = 1;

    protected $guarded = 'admin';

    protected $fillable = [
        'name','phone', 'email', 'password','gender','role'
    ];
}
