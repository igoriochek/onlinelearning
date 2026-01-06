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
    $users = User::orderBy('last_login_at', 'desc')
      ->paginate(20);

    return view('admin.users.index', compact('users'));
  }

  public function toggleStatus(User $user)
  {
    try {
      $user->update([
        'account_status' => $user->account_status === 'active'
          ? 'blocked'
          : 'active',
      ]);

      return back()->with('success', __('toast.user.status_updated'));
    } catch (\Exception $e) {
      return back()->with('error', __('toast.user.status_update_failed'));
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
        return back()->with('success', __('toast.user.role_updated', [
          'role' => __('roles.' . $user->role),
        ]));
      }

      return back()->with('info', __('toast.generic.no_changes'));
    } catch (\Exception $e) {
      return back()->with('error', __('toast.user.role_update_failed'));
    }
  }

  public function destroy(User $user)
  {

    if (Auth::id() === $user->id) {
      return back()->with('error', __('toast.user.cannot_delete_self'));
    }

    if ($user->isAdmin()) {
      return back()->with('error', __('toast.user.cannot_delete_admin'));
    }

    try {
      $user->delete();
      return redirect()->route('admin.users.index')
        ->with('success', __('toast.user.deleted'));
    } catch (\Exception $e) {
      return redirect()->route('admin.users.index')
        ->with('error', __('toast.user.delete_failed'));
    }
  }
}
