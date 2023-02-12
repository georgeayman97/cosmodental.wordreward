<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->user() == null){
            return redirect('/login');
        }else{
            return redirect()->route('user.index');
        }
    }
}
