<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function storeComment(Post $post){
        //validation
        request()->validate([
            'body'=>'required'
        ]);
        //add a comment to the given post
        // $post->comments() will automaticly insert post_id
        $post->comments()->create([
            'user_id'=>auth()->id(), //auth()->id() or auth()->user()->id or request()->user()-id
            'body'=>request('body')
        ]);

        // traditional way
        // Comment::create([
        //     'user_id'=>$post->user_id,
        //     'post_id'=>$post->id,
        //     'body'=>request()->body
        // ]);

        return back();

    }
}
