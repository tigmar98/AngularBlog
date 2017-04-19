<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_topic');
            $table->string('post', 255);
            /*$table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users');*/
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
           Schema::dropIfExists('posts');

    }
}
