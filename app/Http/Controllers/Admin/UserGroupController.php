<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        $groups = UserGroup::all();

        return view('admin.usergroup.index')->with([
            'groups' => $groups,
        ]);
    }

    public function create()
    {
        $groups = UserGroup::all();

        return view('admin.usergroup.create', [
            'groups' => $groups,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:user_groups',
            'maximum_points' => 'required',
            'minimum_balance_to_allow_transfer' => 'required',
        ]);
        // $request->validate(UserGroup::validateRules());
        $validated['level'] = UserGroup::count() + 1;
        UserGroup::create($validated);

        return redirect()->route('group.index')->with('success', trans('Group.created'));
    }

    public function destroy($id)
    {
        $group = UserGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('group.index')->with('success', "$group->name Deleted Successfully");
    }
}
