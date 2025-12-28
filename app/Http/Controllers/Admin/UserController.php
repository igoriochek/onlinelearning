<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index()
  {
    $users = User::orderBy('created_at', 'desc')->paginate(20);

    return view('admin.users.index', compact('users'));
  }

  public function toggleStatus(User $user)
  {
    try {
      $user->update([
        'account_status' => $user->account_status === 'active' ? 'blocked' : 'active'
      ]);

      return back()->with('success', 'User status updated successfully.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to update user status.');
    }
  }

  public function updateRole(Request $request, User $user)
  {
    $request->validate([
      'role' => 'required|in:student,teacher,admin',
    ]);

    $user->fill($request->only('role'));

    try {
      if ($user->isDirty()) {
        $user->save();
        return back()->with('success', "Role updated to {$user->role}.");
      }

      return back()->with('info', 'No updates were applied.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to update user role.');
    }
  }

  public function destroy(User $user)
  {

    if (Auth::id() === $user->id) {
      return back()->with('error', 'You cannot delete your own account.');
    }

    if ($user->isAdmin()) {
      return back()->with('error', 'You cannot delete another admin.');
    }

    try {
      $user->delete();
      return redirect()->route('admin.users.index')
        ->with('success', 'User deleted successfully');
    } catch (\Exception $e) {
      return redirect()->route('admin.users.index')
        ->with('error', 'Failed to delete user.');
    }
  }
}
