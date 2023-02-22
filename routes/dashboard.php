<?php

use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PointsController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TransactionTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->resource('user', UserController::class);
Route::middleware('admin')->put('userupdate/{user}', [UserController::class,'updateUser'])->name('user.updateUser');
Route::middleware('admin')->resource('group', UserGroupController::class);
/*==================================================Points==================================================*/
Route::post('{user}/add_points', [PointsController::class, 'addPoints'])
    ->name('user.add_points');
Route::post('{user}/usePoints', [PointsController::class, 'redeemPoints'])
    ->name('user.redeem_points');

Route::get('transactions', [TransactionController::class, 'index'])
    ->name('transactions.index')
    ->middleware('admin');
/*==================================================UserGroup==================================================*/
// Route::name('usergroup.')->prefix('usergroup')->middleware('auth')->group(function () {
//     Route::get('create', [UserGroupController::class, 'create'])
//         ->name('newAdmin');
//     Route::post('', [UserGroupController::class, 'store'])
//         ->name('store');
// });

/*==================================================Notifications==================================================*/
Route::get('notify_user/{user?}', [NotificationController::class, 'notifyUser'])
    ->name('notify.user');
Route::post('notify_user', [NotificationController::class, 'notifyUserCreate'])
    ->name('notify.user.create');
Route::get('notify_group/{group?}', [NotificationController::class, 'notifyGroup'])
    ->name('notify.group');
Route::post('notify_group', [NotificationController::class, 'notifyGroupCreate'])
    ->name('notify.group.create');
Route::get('notify_all', [NotificationController::class, 'notifyAll'])
    ->name('notify.all');
Route::post('notify_all', [NotificationController::class, 'notifyAllCreate'])
    ->name('notify.all.create');
/*==================================================Transactions==================================================*/
Route::post('accept-transaction', [TransactionController::class, 'accept'])
    ->name('transactions.accept');
Route::post('reject-transaction', [TransactionController::class, 'reject'])
    ->name('transactions.reject');
/*==================================================settings==================================================*/
Route::resource('settings',TransactionTypeController::class);