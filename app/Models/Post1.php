<?php

namespace App\Models;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post {
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title=$title;
        $this->excerpt=$excerpt;
        $this->date=$date;
        $this->body=$body;
        $this->slug=$slug;
    }

    public static function find($slug){
        //Second Approach; return Post Object
        return static::all()->firstWhere('slug',$slug);

        //First Approach
        // if(!file_exists($path=  resource_path("posts/{$slug}.html"))){
        //     throw new ModelNotFoundException();
        // }

        // //Caching
        // return cache()->remember("posts.{$slug}", 1200, function() use ($path){
            //   // dd($slug);
        //     return file_get_contents($path);
        // });
    }
    public static function findOrFail($slug){
        //Second Approach; return Post Object
        $post= static::find($slug);
        if(! $post){
            throw new ModelNotFoundException();
        }
        return $post;
    }
    public static function all(){
        //Second Approach
        //Using double mapping
        return cache()->rememberForever('posts.all', function(){
            return Collect(File::files(resource_path("posts/")))
                ->map(function($file){
                    return YamlFrontMatter::parseFile($file);
                })
                ->map(function($document){
                    return new Post(
                        $document->title,

                        $document->excerpt,

                        $document->date,

                        $document->body(),

                        $document->slug
                    );
              })->sortByDesc('date');
        });

        //First Approach
        // $files=File::files(resource_path("posts/"));
        // return array_map(function($file){
        //     return $file->getContents();
        // },$files);
        // // dd($files);
        // //using arrow function
        // // return array_map(fn($file) => $file->getContents(),$files);
    }
}
