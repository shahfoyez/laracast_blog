<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index(){

    }
    public function create(){
       return view('register.create');
    }
    public function store(){
        // return request()->all();  //for firefox
        // dd(request()->all());
        $attributes=request()->validate([
            'username'=> ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'name'=> 'required | min:3 | max:255',
            'email'=> 'required|email|max:255|unique:users,email',
            'password'=> ['required', 'min:4', 'max: 255']
        ]);
        // dd($attributes);
        // $attributes['password']=bcrypt($attributes['password']); //Use when no mutator function in action
        $user= User::create($attributes);
        auth()->login($user);

        session()->flash('success', 'Your account has been created');

        return redirect('/'); //->with('success', 'Your account has been created') //use insted of session flash
    }
}
