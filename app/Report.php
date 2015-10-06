<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table = 'news';

    protected $fillable = ['title', 'body', 'author'];

    public function school()
    {
    	return $this->belongsTo(School::class);
    }
}
