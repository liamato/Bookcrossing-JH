<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'school_id'];

    protected $hidden = ['school_id'];

    protected $relationship = ['school' => 'school_id', 'posts' => ''];

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    static public function bySlug($slug, $school = null)
    {
        if (!$school instanceof School) {
            if (is_numeric($school)) {
                $school = School::findOrFail($school);
            } elseif (is_string($school)) {
                $school = School::bySlug($school);
            } elseif (is_null($school)) {
                $school = \App::make(School::class);
            }
        }

        return static::where('slug', $slug)->where('school_id', $school->id)->firstOrFail();
    }

    public function scopebySchool($q, $school)
    {
        return $q->where('school_id', School::where((is_numeric($school) ? 'id' : 'slug'), $school)->firstOrFail()->id);
    }
}
