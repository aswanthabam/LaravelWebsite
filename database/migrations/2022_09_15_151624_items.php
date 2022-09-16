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
        	$table->string("item_id")->nullable()->unique();
        	$table->string("name");
        	$table->string("version_name");
        	$table->string("description");
        	$table->string("readme")->nullable();
        	$table->string("author")->nullable();
        	$table->string("platform")->nullable();
        	$table->string("download_link")->nullable();
        	$table->string("view_link")->nullable();
        	$table->string("project");
        	$table->string("details")->nullable();
        	$table->string("keywords")->nullable();
        	$table->string("base64eq")->nullable();
        	$table->string("release_name");
        	
        	$table->dateTime("created_at")->nullable();
        	$table->dateTime("updated_at")->nullable();
        	$table->dateTime("added_on");
        	$table->dateTime("changed_on");
        	
        	$table->integer("version");
        	$table->integer("downloads")->default(0);
        	$table->integer("likes")->default(0);
        	
        	$table->boolean("is_latest")->default(true);
        	$table->boolean("downloadable")->default(true);
        	$table->boolean("viewable")->default(true);
        	
        	$table->unsignedBigInteger('latest')->nullable();
        	$table->foreign("latest")->references("id")->on("items");
        	$table->unsignedBigInteger('user_id')->nullable();
        	$table->foreign("user_id")->references("id")->on("admins");
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
