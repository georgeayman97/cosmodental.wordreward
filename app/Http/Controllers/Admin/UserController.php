<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query()->filter(request()->except('page'))->orderBy('name','asc');
        $users = $query->with('userGroup')->orderByDesc('created_at')->paginate(10);
        $groups = UserGroup::all();

        return view('admin.user.index', compact('users', 'groups'));
    }

    public function show(User $user)
    {
        $user->load('userTransactions');
        $userGroups = UserGroup::all();

        return view('admin.user.show', compact('user', 'userGroups'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
    }

    public function search()
    {
        $users = User::findByNameOrPhone(request()->q);

        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        //
        $user = Admin::findOrFail($id);
        return view('admin.admin.edit',[
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => ['required', 'max:30'],
            'user_group_level' => ['required'],
        ]);
        $user->update($validated);

        return back()->with(['msg' => 'Changed Group Successfully']);
    }


    public function updateUser(Request $request, $id)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = Admin::findOrFail($id);

        $user->update([
            'name' => request()->name,
            'phone' => request()->phone,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        return redirect()->route('dashboard')->with('success', trans('User.updated'));

    }

    public function destroy($id)
    {
        //
    }
}