<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'school_id'];

    protected $hidden = ['created_at', 'updated_at', 'checked', 'school_id'];

    protected $relationship = ['school' => 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function scopebySchool($q, $school)
    {
    	return $q->where('school_id', School::where((is_numeric($school) ? 'id' : 'slug'), $school)->firstOrFail()->id);
    }
}
