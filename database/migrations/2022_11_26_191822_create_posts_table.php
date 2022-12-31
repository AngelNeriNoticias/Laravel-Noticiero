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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('title');
            $table->longText('body');
            $table->longText('url')->nullable();
            $table->string('photo');
            $table->integer('visitors')->default(0);
            $table->boolean('share')->default(false);
            $table->boolean('comments')->default(false);
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
        Schema::dropIfExists('posts');
    }
};
