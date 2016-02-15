<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name' ,'slug'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $relationship = ['books' => '', 'users' => '', 'categories' => '', 'news' => '', 'posts' => '', 'videos' => ''];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function categories()
    {
    	return $this->hasMany(Category::class);
    }

    public function news()
    {
    	return $this->hasMany(Report::class);
    }

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function videos()
    {
    	return $this->hasMany(Video::class);
    }

    static public function bySlug($slug, $with = [])
    {
        return static::with($with)->where('slug', $slug)->firstOrFail();
    }
}
