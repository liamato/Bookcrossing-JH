<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'author'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function childs()
    {
    	return $this->hasMany(Post::class, 'id', 'parent');
    }

    public function parent()
    {
    	return $this->belongsTo(Post::class, 'id', 'parent');
    }

    public function school()
    {
    	return $this->belongsTo(School::class);
    }
}
