<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['code'];

    protected $hidden = ['updated_at'];

    public function school()
    {
    	return $this->belongsTo(School::class);
    }

    public function scopebyCode($q, $code)
    {
        return $q->where('code',$code)->firstOrFail();
    }

    public function scopebySchool($q, $school)
    {
        return $q->where('school_id', School::where((is_numeric($school) ? 'id' : 'slug'), $school)->firstOrFail()->id);
    }
}
