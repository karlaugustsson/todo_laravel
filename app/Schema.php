<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Schema extends Model
{
	public function user(){
		return $this->belongsTo("App\User");
	}
    public function subscribed_users(){
        return $this->belongsToMany('App\User')->withPivot('user_id', 'schema_id');
    }
    protected $hidden = [
        'user_id'
    ];
}
