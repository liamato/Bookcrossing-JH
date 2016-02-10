<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'author'];

    protected $hidden = ['school_id', 'checked'];

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

    public function scopebySchool($q, $school)
    {
        return $q->where('school_id', School::where((is_numeric($school) ? 'id' : 'slug'), $school)->firstOrFail()->id);
    }
}
