<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
