<?php

namespace App\Http\Controllers;
use Exception;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Auth_index()
    {
        return view('auth.signup_login');
    }

    public function signup(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('Auth.index')->with('success','Your account has been created successfully.');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

            if (Auth::attempt($request->only("email", "password"))) {
                return redirect()->route('app.index');
            } else {
                return redirect()->route('Auth.index')->with('error','email password not match.');
            }
        } catch (Exception $e) {
            dd($e);
        }


    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
