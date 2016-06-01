<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaBlockUserRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("schema_block_user" ,function( Blueprint $table ){
            $table->integer("user_id")->unsigned()->nullable();
            $table->integer("schema_block_id")->unsigned()->nullable();

            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("schema_block_id")->references("id")->on("schema_blocks")->onDelete('cascade');
            $table->index(['user_id' , 'schema_block_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("schema_block_user");
    }
}
