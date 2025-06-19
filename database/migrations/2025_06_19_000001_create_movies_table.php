<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('poster');
            $table->string('release_date');
            $table->string('duration');
            $table->decimal('imdb_rating', 3, 1);
            $table->integer('views')->default(0);
            $table->string('genre');
            $table->string('director');
            $table->string('cast');
            $table->string('language');
            $table->string('category');
            $table->text('storyline');
            $table->string('trailer_embed_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
};