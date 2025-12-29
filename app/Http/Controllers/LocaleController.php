<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LocaleController extends Controller
{
  public function change(string|null $locale): RedirectResponse
  {
    try {
      if (!in_array($locale, config('app.available_locales'))) {
        throw new HttpException(400, __('toast.locale.invalid'));
      }
      session()->put('locale', $locale);

      return back()->withCookie(cookie('locale', $locale, 60 * 24 * 7));
    } catch (HttpException $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
