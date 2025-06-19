<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tv_show_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tv_show_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tv_show_ratings');
    }
};