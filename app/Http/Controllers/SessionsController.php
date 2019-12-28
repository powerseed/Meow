<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view("sessions.create");
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ]
        );

        if(Auth::attempt($credentials))
        {
            session()->flash("success", "Logged in successfully! ");

            return redirect()->route('users.show', [Auth::user()]);
        }
        else
        {
            session()->flash("danger", "Invalid username or password. ");
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash("success", "Logged out successfully. ");
        return redirect()->route("login");
    }
}
