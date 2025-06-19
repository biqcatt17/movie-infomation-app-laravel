<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movie_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('movie_id')->constrained('movies');
            $table->timestamps();
            
            // Add unique constraint
            $table->unique(['user_id', 'movie_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('movie_ratings');
    }
};