<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("schema_blocks",function($table){
            $table->increments("id");
            $table->integer("schema_id")->unsigned()->nullable();
            $table->string("name")->nullable();
            $table->string("desc")->nullable();
            $table->timestamps();

            $table->foreign("schema_id")->references("id")->on("schemas")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("schema_blocks");
    }
}
