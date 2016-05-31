<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Schema extends Model
{
	public function schemas(){
		return $this->hasManyThrough('App\User', 'App\schemas');
	}
}
