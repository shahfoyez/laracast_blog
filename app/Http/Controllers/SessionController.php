<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('/')->with('success', 'You are loged out!');
    }
    public function create(){
         return view('sessions.create');
    }
    public function store(){
        // validate the request
        // returns current input
        $attributes=request()->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        // attempt to authenticate
        // attempt() does both signing session and check email and password match
        if(!auth()->attempt($attributes)){
            // if auth failed
            // technique 1
            throw ValidationException::withMessages([
                'error'=>'Your credential did not match.'
            ]); //automaticlt returns current input

            // technique 2
            // return back()
            //     ->withInput()  // manually return current input
            //     ->withErrors(['error'=>'Your credential did not match.']);
        }
        session->regenerate(); // session fixation

        return redirect('/')->with('success', 'You are loged In'); //with value assign in session
   }
}
