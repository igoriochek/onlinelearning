<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use App\Services\Admin\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  protected $dashboard;

  public function __construct(DashboardService $dashboard)
  {
    $this->dashboard = $dashboard;
  }

  public function index()
  {
    return view('admin.dashboard.index', $this->dashboard->getDashboardData());
  }
}
