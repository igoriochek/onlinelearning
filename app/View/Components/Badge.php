<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
  public $type;
  public $classes;
  /**
   * Create a new component instance.
   */
  public function __construct($type = 'default')
  {
    $this->type = $type;

    $statusMap = [
      'active'   => 'success',
      'approved' => 'success',
      'blocked'  => 'danger',
      'rejected' => 'danger',
      'pending'  => 'warning',
      'admin'    => 'info',
      'teacher'  => 'warning',
      'student'  => 'neutral',
    ];

    $colors = [
      'success' => 'bg-green-100 text-green-800 border border-green-800',
      'danger'  => 'bg-red-100 text-red-800 border border-red-800',
      'warning' => 'bg-yellow-100 text-yellow-800 border border-yellow-800',
      'info'    => 'bg-blue-100 text-blue-800 border border-blue-700',
      'neutral' => 'bg-gray-100 text-gray-800 border border-gray-500',
      'default' => 'bg-gray-100 text-gray-800 border border-gray-500',
    ];

    $key = $statusMap[$type] ?? $type;
    $this->classes = $colors[$key] ?? $colors['default'];
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.badge');
  }
}
