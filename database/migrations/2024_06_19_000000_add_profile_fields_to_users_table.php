<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Check if columns don't exist before adding them
                if (!Schema::hasColumn('users', 'birth_date')) {
                    $table->date('birth_date')->nullable();
                }
                if (!Schema::hasColumn('users', 'bio')) {
                    $table->text('bio')->nullable();
                }
                if (!Schema::hasColumn('users', 'profile_picture')) {
                    $table->string('profile_picture')->nullable();
                }
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['birth_date', 'bio', 'profile_picture']);
        });
    }
};