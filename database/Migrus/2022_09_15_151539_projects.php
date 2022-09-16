<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("projects",function (Blueprint $table)
        {
        	$table->id();
        	$table->string("name");
        	$table->string("version_name");
        	$table->string("description");
        	$table->string("readme");
        	$table->string("author");
        	$table->string("platform");
        	$table->string("latest");
        	$table->string("details");
        	
        	$table->dateTime("created_at");
        	$table->dateTime("updated_at");
        	$table->dateTime("added_on");
        	$table->dateTime("changed_on");
        	
        	$table->integer("version");
        	$table->integer("downloads");
        	$table->integer("likes");
        	$table->integer("item_count");
        	
        	$table->boolean("is_latest");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("projects");
    }
};
