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

    public function edit($id)
    {
        $groups = UserGroup::all();
        $group = UserGroup::findOrFail($id);
        // withTrashed()  used for including soft deleted items 
        // onlyTrashed()  find just deleted items
        return view('admin.usergroup.edit',[
            'group' => $group,
            'groups' => $groups,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'maximum_points' => 'required',
            'minimum_balance_to_allow_transfer' => 'required',
        ]);
        $group = UserGroup::findOrFail($id);

        $group->update($request->all());
        return redirect()->route('group.index')->with('success', trans('Group.updated'));

    }

    public function destroy($id)
    {
        $group = UserGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('group.index')->with('success', "$group->name Deleted Successfully");
    }
}