<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostCommentsController;

class PostController extends Controller
{
    public function index(){
        // dd(request(['category']));
        // dd(request()->only('search'));
        return view('posts.index',[
            'posts'=> Post::latest()->filter(request(['search','category','author']))->paginate(6)->withQueryString(), //simplePaginate(6) //withQueryString for current input
            //->with('category','author'), use when we don't have Eager Load Relationships on an Existing Model
            'CurrentCategory'=> Category::firstWhere('slug', request('category'))
        ]);
    }
    public function show(Post $post){
        // $post= Post::all(); //If no model Binding
        return view('posts.show',[
            'post'=> $post
        ]);
    }
}
