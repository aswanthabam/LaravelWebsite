<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_id')->nullable()->unique();
            $table->string('name');
            $table->string('version_name');
            $table->string('description');
            $table->string('readme')->nullable();
            $table->string('author')->nullable();
            $table->string('platform')->nullable();
            $table->string('download_link')->nullable();
            $table->string('view_link')->nullable();
            $table->string('project');
            $table->string('details')->nullable();
            $table->string('keywords')->nullable();
            $table->string('base64eq')->nullable();
            $table->string('release_name');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('added_on');
            $table->dateTime('changed_on');
            $table->integer('version');
            $table->integer('downloads')->default(0);
            $table->integer('likes')->default(0);
            $table->boolean('is_latest')->default(true);
            $table->boolean('downloadable')->default(true);
            $table->boolean('viewable')->default(true);
            $table->integer('latest')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('image')->nullable();
            $table->string('author_link')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('multi_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
