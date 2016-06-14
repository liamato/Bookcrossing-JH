<?php

namespace App;

use Illuminate\Auth\Authenticatable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'super', 'school_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'super', 'created_at', 'updated_at', 'school_id'];

    protected $relationship = ['school' => 'school_id'];


    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function isSuper()
    {
        return $this->super;
    }

    public function inSchool(School $school = null)
    {
        if (!$school) {
            $school = \App::make(School::class);
        }
        return $school->id === $this->school->id;
    }

    public function scopebyMail($q, $mail)
    {
        return $q->where('email',$mail)->firstOrFail();
    }

    public function scopebySchool($q, $school)
    {
        return $q->where('school_id', School::where((is_numeric($school) ? 'id' : 'slug'), $school)->firstOrFail()->id);
    }
}
