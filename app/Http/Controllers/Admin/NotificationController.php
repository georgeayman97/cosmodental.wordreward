<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notifyUser(User $user = null)
    {
        $user = $user??User::all();
        
        return view('admin.notifications.notify_user', [
            'user' => $user
        ]);
    }
    
    public function notifyUserCreate(Request $request)
    {
        
        $request->validate([
            'user_id' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required'],
        ]);
        $user = User::where('id',$request->user_id)->first();
        $user->sendNotification($user->device_token,$request->title,$request->message);
        $user->notifications_count++;
        $user->save();
        Notification::create([
            'user_id'=>$user->id,
            'title'=>$request->title,
            'description'=>$request->message,
            'status'=>'unread',
        ]);
        return redirect()->back();
    }
    public function notifyGroup(UserGroup $group = null)
    {
        $group = $group??UserGroup::all();
        return view('admin.notifications.notify_group', [
            'group' => $group
        ]);
    }
    public function notifyGroupCreate(Request $request)
    {
        $request->validate([
            'group_id' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required'],
        ]);
        $users = User::where('user_group_level',$request->group_id)->get();
        foreach($users as $user){
            $user->sendNotification($user->device_token,$request->title,$request->message);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id'=>$user->id,
                'title'=>$request->title,
                'description'=>$request->message,
                'status'=>'unread',
            ]);
        }
        return redirect()->back();
    }
    public function notifyAll()
    {
        return view('admin.notifications.notify_all');
    }
    public function notifyAllCreate(Request $request)
    {
        
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required'],
        ]);
        $users = User::all();
        foreach($users as $user){
            $user->sendNotification($user->device_token,$request->title,$request->message);
            $user->notifications_count++;
            $user->save();
            Notification::create([
                'user_id'=>$user->id,
                'title'=>$request->title,
                'description'=>$request->message,
                'status'=>'unread',
            ]);
        }
        return redirect()->back();
    }
}