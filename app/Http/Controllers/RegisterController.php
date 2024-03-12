<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    function create(){
        return view('register.create', [
            //'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(3)->withQueryString(),
        ]);
    }

    function store(){
        // var_dump(request()->all());
      $atrributes =  request()->validate([
            'name'=>['required','string','max:255'],
            'username'=>['required','string','max:255', 'min:3', 'unique:users,username'],
            'email'=> ['required','string','max:255'],
            'password'=> ['required','string','max:255', 'min:8','unique:users,email'],
        ]);

        $user = User::create($atrributes);

        auth()->login($user);

        return redirect('/')->with('success','Your account has been created');;
    }
}
