<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $recentUsers = User::latest()->take(5)->get();
    $recentReviews = Review::latest()->take(5)->with('user')->get();

    return view('admin.dashboard.index', compact('recentUsers', 'recentReviews'));
  }
}
