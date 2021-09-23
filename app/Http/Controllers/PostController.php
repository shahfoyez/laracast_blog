<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){
        // dd(request(['search']));
        // dd(request()->only('search'));
        return view('posts',[
            'posts'=> Post::latest()->filter(request(['search']))->get(), //->with('category','author'), use when we dont have Eager Load Relationships on an Existing Model
            'categories'=>Category::all()
        ]);
    }
    public function show(Post $post){
        // $post= Post::all(); //If no model Binding
        return view('post',[
            'post'=> $post,
            'categories'=>Category::all()
        ]);
    }

}
