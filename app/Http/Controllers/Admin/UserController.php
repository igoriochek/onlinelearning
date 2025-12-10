<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $users = User::orderBy('created_at', 'desc')->paginate(20);

    return view('admin.users.index', compact('users'));
  }

  public function toggleStatus(User $user)
  {
    $user->update([
      'account_status' => $user->account_status === 'active' ? 'blocked' : 'active'
    ]);

    return back()->with('success', 'User status updated successfully.');
  }

  public function updateRole(Request $request, User $user)
  {
    $request->validate([
      'role' => 'required|in:student,teacher,admin',
    ]);

    $user->fill($request->only('role'));

    if ($user->isDirty()) {
      $user->save();
      return back()->with('success', "Role updated to {$user->role}.");
    }

    return back()->with('info', 'No updates were applied.');
  }
}
