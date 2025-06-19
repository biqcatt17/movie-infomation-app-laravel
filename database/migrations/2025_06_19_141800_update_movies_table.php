<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('release_date')->after('poster')->nullable();
            $table->integer('views')->after('imdb_rating')->default(0);
            $table->string('category')->after('language')->nullable();
            $table->text('storyline')->after('category')->nullable();
            $table->string('trailer_embed_url')->after('storyline')->nullable();
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn([
                'release_date',
                'views',
                'category',
                'storyline',
                'trailer_embed_url'
            ]);
        });
    }
};