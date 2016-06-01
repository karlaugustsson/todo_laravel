<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',"admin"
    ];

    public function schemas(){
        return $this->hasMany("App\Schema");
    }
    public function subscribed_schemas(){
        return $this->belongsToMany('App\Schema');
    }
    public function schema_blocks(){
        return $this->BelongsToMany("App\SchemaBlock");
    }
    public function isAdmin()
    {
        return ($this->admin);
    }
}
