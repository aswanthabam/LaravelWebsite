<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_id')->unique();
            $table->string('name');
            $table->string('version_name');
            $table->string('description');
            $table->string('readme')->nullable();
            $table->string('author')->nullable();
            $table->string('platform')->nullable();
            $table->string('details')->nullable();
            $table->string('keywords')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('added_on');
            $table->dateTime('changed_on');
            $table->integer('version')->default(1);
            $table->integer('downloads')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('item_count')->default(0);
            $table->boolean('is_latest')->default(true);
            $table->boolean('single_item_project')->default(true);
            $table->integer('latest')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('image')->nullable();
            $table->string('author_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
