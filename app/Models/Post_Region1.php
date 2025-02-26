<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Region extends Model
{
    /** @use HasFactory<\Database\Factories\PostRegionFactory> */
    use HasFactory;

    // protected $fillable = [
    //     'post_id',
    //     'region_id',
    // ];

    // public function post(){return $this->hasOne(Post::class);}
    // public function region(){return $this->hasOne(Region::class);}
}
