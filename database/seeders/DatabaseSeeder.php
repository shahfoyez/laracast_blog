<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();
        // Create an User
        $user=User::factory()->create([
            'name'=>'JohnDoe'
        ]);

        // Create post with User->id reference
        $post=Post::factory(10)->create([
            'user_id'=>$user->id
        ]);


        // $user= User::factory()->create();

        // $personal= Category::create([
        //     'name'=>'Personal',
        //     'slug'=>'personal'
        // ]);
        // $family= Category::create([
        //     'name'=>'Family',
        //     'slug'=>'family'
        // ]);
        // $work= Category::create([
        //     'name'=>'Work',
        //     'slug'=>'work'
        // ]);
        // Post::create([
        //     'user_id'=>$user->id,
        //     'category_id'=>$family->id,
        //     'title'=>'My family post',
        //     'slug'=>'my-family-post',
        //     'excerpt'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>',
        //     'body'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda quaerat tempora veniam dolorum asperiores quia placeat nisi dolore deleniti esse, illum libero similique. Iure quod fugit magni ab iste.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda quaerat tempora veniam dolorum asperiores quia placeat nisi dolore deleniti esse, illum libero similique. Iure quod fugit magni ab iste.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda quaerat tempora veniam dolorum asperiores quia placeat nisi dolore deleniti esse, illum libero similique.</p>'
        // ]);
        // Post::create([
        //     'user_id'=>$user->id,
        //     'category_id'=>$work->id,
        //     'title'=>'My work post',
        //     'slug'=>'my-work-post',
        //     'excerpt'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>',
        //     'body'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda quaerat tempora veniam dolorum asperiores quia placeat nisi dolore deleniti esse, illum libero similique. Iure quod fugit magni ab iste.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda quaerat tempora veniam dolorum asperiores quia placeat nisi dolore deleniti esse, illum libero similique. Iure quod fugit magni ab iste.Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda quaerat tempora veniam dolorum asperiores quia placeat nisi dolore deleniti esse, illum libero similique.</p>'
        // ]);

    }
}
