<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaUserRelationship extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("schema_user",function(Blueprint $table){
            $table->integer("user_id")->unsigned()->nullable();
            $table->integer("schema_id")->unsigned()->nullable();

            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("schema_id")->references("id")->on("schemas")->onDelete('cascade');
            $table->index(['user_id' , 'schema_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schema_user');
    }
}
