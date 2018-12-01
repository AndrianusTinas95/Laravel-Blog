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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->default('default.png')->nullable();
            $table->text('body');
            $table->integer('view');
            $table->boolean('status')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->timestamps();

            $table->foreign('author')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
