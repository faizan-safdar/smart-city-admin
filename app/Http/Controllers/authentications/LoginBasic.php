<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function indexPost(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ], [
      'email.required' => 'Email is required',
      'email.email' => 'Invalid email format',
      'password.required' => 'Password is required',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      return redirect('/');
    }
    return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

}
