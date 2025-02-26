<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, Searchable;

    protected $fillable = [
        'user_id',
        'category_id',
        'region_id',
        'title',
        'content',
        'price',
        'image',
    ];

    public function user(){return $this->belongsTo(User::class, 'user_id');}
    public function categor(){return $this->belongsTo(Category::class,'category_id');}
    public function region(){return $this->belongsTo(Region::class,'region_id');}
    public function tags(){return $this->belongsToMany(Tag::class);}
}
