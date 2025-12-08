<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
  public $user;
  /**
   * Create a new component instance.
   */
  public function __construct($user)
  {
    $this->user = $user;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.avatar');
  }

  public function placeholderColor(): string
  {
    $pairs = [
      ['bg-red-100', 'text-red-700'],
      ['bg-blue-100', 'text-blue-700'],
      ['bg-green-100', 'text-green-700'],
      ['bg-yellow-100', 'text-yellow-700'],
      ['bg-orange-100', 'text-orange-700'],
      ['bg-purple-100', 'text-purple-700'],
    ];

    $index = abs(crc32($this->user->name)) % count($pairs);
    return implode(' ', $pairs[$index]);
  }

  public function placeholderInitial(): string
  {
    return strtoupper(substr($this->user->name, 0, 1));
  }
}
