<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\Newsletter;

class NewsLetterController extends Controller
{
    public function __invoke(Newsletter $newsletter){   //
        // dd($newsletter);

        $validation= request()->validate([
            'email' => 'required|email'
        ]);
        try{
            $newsletter->subscribe(request()->email);
        }catch(\Exception $e){
            throw ValidationException::withMessages([
                'email' => 'This email could not be added.'
            ]);
        }
        return redirect('/')->with('success', 'You have subscribed to our newsletter');
    }
}
