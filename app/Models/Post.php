<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with=['category', 'author'];
    // protected $fillable=['title','excerpt','body'];

    public function scopeFilter($query, array $filters){ //$query is query builder pass by laravel
        // dd($query);
        // if($filters['search'] ?? false){
        //     dd($filters['search']);
        // }else{
        //      dd("no search");
        // }
        $query->when($filters['search'] ?? false, function($query, $search){
            $query->where('title','like','%'.$search.'%')
                  ->orWhere('body','like','%'.$search.'%');
        });
        // if($filter['search'] ?? true){
        //     $query->where('title','like','%'.request('search').'%')
        //         ->orWhere('body','like','%'.request('search').'%');
        // }
    }
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
