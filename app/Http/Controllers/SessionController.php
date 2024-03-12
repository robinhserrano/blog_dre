<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function create()
    {
        return view('session.create');
    }


    public function store()
    {
        $attributes =  request()->validate(['email' => ['required', 'email'], 'password' =>  ['required']]);

        if (!auth()->attempt($attributes)) {

            return back()->withInput()->withErrors(['email' => ["You're provided credentials could not be verified"]]);
        }

        session()->regenerate();
        return redirect('/')->with('success', 'welcome back');
    }
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye');
    }
}
