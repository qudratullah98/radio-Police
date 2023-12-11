<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMetaCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_meta_comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('comment')->nullable();

            $table->unsignedBigInteger('post_meta_id');
            // $table->foreign('post_id')
            // ->references('id')->on('posts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_meta_comments');
    }
}