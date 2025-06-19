<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Check if columns exist using PostgreSQL syntax
        $columns = DB::select("
            SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name = 'users'
        ");
        
        $existingColumns = array_map(function($column) {
            return $column->column_name;
        }, $columns);

        Schema::table('users', function (Blueprint $table) use ($existingColumns) {
            if (!in_array('profile_picture', $existingColumns)) {
                $table->string('profile_picture')->nullable();
            }
            if (!in_array('birth_date', $existingColumns)) {
                $table->date('birth_date')->nullable();
            }
            if (!in_array('bio', $existingColumns)) {
                $table->text('bio')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['profile_picture', 'birth_date', 'bio'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};