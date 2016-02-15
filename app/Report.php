<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table = 'news';

    protected $fillable = ['title', 'body', 'author'];

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
