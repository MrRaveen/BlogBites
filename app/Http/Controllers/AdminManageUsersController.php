<?php

namespace App\Http\Controllers;

use App\Models\BlogUser;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminManageUsersController extends Controller
{
    public function index()
    {
        $users = BlogUser::with('roles')->get();
        $roles = Role::pluck('name');
        return view('adminManageUserView', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request, $userID)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user = BlogUser::findOrFail($userID);
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}

