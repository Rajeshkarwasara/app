<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_login()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')
                    ->with('error', 'You do not have access to this page.');
            }

            return redirect()->route('app.index');

        } else {

            return redirect()->route('admin.login')
                ->with('error', 'The email or password is incorrect.');
        }


    }

    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }
}
