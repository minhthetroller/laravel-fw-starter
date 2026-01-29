<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename 'name' to 'username' for clarity
            $table->renameColumn('name', 'username');
        });

        Schema::table('users', function (Blueprint $table) {
            // Make username unique
            $table->unique('username');
            
            // Add student-specific fields
            $table->string('stuId')->nullable()->after('username');
            $table->string('class')->nullable()->after('stuId');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('class');
            
            // Make email nullable since we're using username for login
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn(['stuId', 'class', 'gender']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('username', 'name');
            $table->string('email')->nullable(false)->change();
        });
    }
};
