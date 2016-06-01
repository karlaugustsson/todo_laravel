<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchemaBlock extends Model
{
    public function schema(){
    	return $this->BelongsTo('App\Schema');
    }
    public function user(){
    	return $this->BelongsToMany("App\User");
    }
}
