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
            $table->string('postTopic');
            $table->string('post', 255);
            $table->integer('categoryId')->unsigned();
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
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
        $table->dropForeign('posts_categoryId_foreign');
        Schema::dropIfExists('posts');

    }
}
