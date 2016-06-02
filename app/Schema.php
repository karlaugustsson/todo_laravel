<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Schema extends Model
{
	public function user(){
		return $this->belongsTo("App\User");
	}
    public function subscribed_users(){
        return $this->belongsToMany('App\User');
    }

    public function schema_blocks(){
    	return $this->hasMany('App\SchemaBlock');
    }
    protected $hidden = [
        'user_id'
    ];
    
}
