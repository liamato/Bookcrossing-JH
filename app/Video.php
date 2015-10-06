<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['code'];

    public function school()
    {
    	return $this->belongsTo(School::class);
    }
}
