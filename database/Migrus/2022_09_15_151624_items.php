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
        Schema::create("items",function (Blueprint $table)
        {
        	$table->id();
        	$table->string("name");
        	$table->string("version_name");
        	$table->string("description");
        	$table->string("readme");
        	$table->string("author");
        	$table->string("platform");
        	$table->string("download_link");
        	$table->string("view_link");
        	$table->string("latest");
        	$table->string("project");
        	$table->string("details");
        	
        	$table->dateTime("created_at");
        	$table->dateTime("updated_at");
        	$table->dateTime("added_on");
        	$table->dateTime("changed_on");
        	
        	$table->integer("version");
        	$table->integer("downloads");
        	$table->integer("likes");
        	
        	$table->boolean("is_latest");
        	$table->boolean("downloadable");
        	$table->boolean("viewable");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("items");
    }
};
