<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with=['category', 'author']; //Eager loading for solving n+1 problem
    // protected $fillable=['title','excerpt','body'];

    public function scopeFilter($query, array $filters){ //$query is query builder pass by laravel
        // dd($query);
        // if($filters['search'] ?? false){
        //     dd($filters['search']);
        // }else{
        //      dd("no search");
        // }

        //Search Second Concept
        $query->when($filters['search'] ?? false, fn($query, $search)=>
            $query->where(fn($query)=>
                $query->where('title','like','%'.$search.'%')
                  ->orWhere('body','like','%'.$search.'%')
            )
        );

        //Category
        $query->when($filters['category'] ?? false, fn($query, $category)=>

            // dd($category);
            //WhereHas Concept
            $query->whereHas('category', fn($query)=>
                 $query->where('slug', $category)
            )

            //WhereExists Concept
            // $query->whereExists(fn($query)=>
            //     $query->from('categories')
            //             ->whereColumn('categories.id', 'posts.id')
            //             ->where('categories.slug', $category)
            // );
        );//Category Ends

        //Author filtering
        $query->when($filters['author'] ?? false, fn($query, $author)=>
            $query->whereHas('author', fn($query)=>
                 $query->where('username', $author)
            )
        );// Author Ends

        //Search first concept
        // if($filter['search'] ?? true){
        //     $query->where('title','like','%'.request('search').'%')
        //         ->orWhere('body','like','%'.request('search').'%');
        // }
    }//ScopeFilter Ends

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function author(){   //user_id foreign key
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
