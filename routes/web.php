<?php
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use phpDocumentor\Reflection\Types\Collection;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);




//Route'0Model Binding
Route::get('/categories/{category:slug}', function(Category $category){
    return view('posts',[
        'posts'=> $category->posts, //->load(['category','author']) ,use when we dont have Eager Load Relationships on an Existing Model
        'CurrentCategory'=>$category,
        'categories'=>Category::all()
    ]);
})->name('category');

Route::get('/authors/{author:username}', function(User $author){
    //  dd($author);
    return view('posts',[
        'posts'=> $author->posts, //->load(['category','author']), use when we dont have Eager Load Relationships on an Existing Model
        'categories'=>Category::all()
    ]);
});

//Route::get('/', function () {
    //     // Search
    //     // dd(request('search'));
    //     $posts= Post::latest();
    //     if(request('search')){
    //         $posts->where('title','like','%'.request('search').'%')
    //               ->orWhere('body','like','%'.request('search').'%');
    //     }


    //     // N+1 problem query log
    //     // $is=\Illuminate\Support\Facades\DB::listen(function($query){
    //     //     logger($query->sql, $query->bindings);
    //     // });

    //     //with for eager loading or to solve n+1 problem
    //     return view('posts',[
    //         'posts'=> $posts->get(), //->with('category','author'), use when we dont have Eager Load Relationships on an Existing Model
    //         'categories'=>Category::all()
    //     ]);
    //     // $files = File::files(resource_path("posts/"));
    //     // dd($files);
    //     // $posts=[];

    //     // //Finallly Using double mapping
    //     // $posts=Collect(File::files(resource_path("posts/")))
    //     //     ->map(function($file){
    //     //         return YamlFrontMatter::parseFile($file);
    //     //     })
    //     //     ->map(function($document){
    //     //         return new Post(
    //     //             $document->title,

    //     //             $document->excerpt,

    //     //             $document->date,

    //     //             $document->body(),

    //     //             $document->slug
    //     //         );
    //     //     });

    //     // //Using arrow function
    //     // $posts=Collect(File::files(resource_path("posts/")))
    //     //     ->map(fn($file)=>YamlFrontMatter::parseFile($file))
    //     //     ->map(fn($document)=>new Post(
    //     //         $document->title,

    //     //         $document->excerpt,

    //     //         $document->date,

    //     //         $document->body(),

    //     //         $document->slug
    //     //     ));

    //     // //Collect data array and wrap them into collection object; return collection obj
    //     // $posts=Collect($files)
    //     //     ->map(function($file){
    //     //         $document = YamlFrontMatter::parseFile($file);
    //     //         return new Post(
    //     //             $document->title,

    //     //             $document->excerpt,

    //     //             $document->date,

    //     //             $document->body(),

    //     //             $document->slug
    //     //         );
    //     //     });
    //     // // dd($posts);

    //     //Parse data using array_map and passing data to constructor; return array that contain Post object
    //     // $posts = array_map(function($file){
    //     //     $document = YamlFrontMatter::parseFile($file);
    //     //     return new Post(
    //     //         $document->title,

    //     //         $document->excerpt,

    //     //         $document->date,

    //     //         $document->body(),

    //     //         $document->slug
    //     //     );
    //     // }, $files);
    //     // dd($posts);

    //     //Parse Data Using YamlFrontMatter or from meta data and passing data to constructor; return array that contain Post object
    //     // foreach($files as $file){
    //     //   // dd($file->getContents());
    //     //    $document= YamlFrontMatter::parseFile($file);
    //     //    //get metter data from $doccument and assign in property
    //     //     $posts[]=new Post(
    //     //         $document->title,

    //     //         $document->excerpt,

    //     //         $document->date,

    //     //         $document->body(),

    //     //         $document->slug
    //     //     );
    //     // }
    //     // // dd($posts);

    //     //return data to the view
    //     // return view('posts',[
    //     //     'posts'=> $posts
    //     // ]);
    //     // dd($document);
    //     // dd($posts);


    //     // $document= YamlFrontMatter::parseFile(
    //     //     resource_path('posts/my-fourth-post.html'
    //     // ));
    //     // dd($document->title);
    //     // // dd($document->body());

    //     // $posts=Post::all();
    //     // // dd($posts);
    //     // return view('posts',[
    //     //     'posts'=> $posts
    //     // ]);
    // })->name('home');

    //Show A Post
    // Route::get('/posts/{post}', function(Post $post){
    //     //Model Binding
    //     return view('post',[
    //         'post'=> $post,
    //         'categories'=>Category::all()
    //     ]);
    //     // //find a post by it's slug and pass it to view called "post"
    //     // return view('post',[
    //     //     'post'=> Post::find($slug)
    //     // ]);

    //     // // return $slug;
    //     // $path=__DIR__."/../resources/posts/{$slug}.html";

    //     // if(!file_exists($path)){
    //     //     return redirect('/');
    //     //     // abort(404);
    //     //     // ddd("File Not Exist");
    //     // }

    //     // //Caching
    //     // $post= cache()->remember("posts.{$slug}", now()->addMinutes(1), function() use ($path){ //"post.{$slug} is an unique key"
    //     //     return file_get_contents($path);
    //     // });
    //     // // $post= cache()->remember("posts.{$slug}", 1200, fn()=>file_get_contents($path));
    //     // // dd($post);
    //     // return view('post',[
    //     //     'post'=> $post
    //     // ]);
    // })->where('post','[A-z_\-]+');
    // // ->whereAlpha('post');
    // //->whereNumber('post');
