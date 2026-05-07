<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('office_space', function (Blueprint $table) {
            $table->id();
            $table->string('property_code');
            $table->string('property_type');
            $table->string('property_owner');
            $table->integer('contact_number');
            $table->string('facebook_link');  
        });

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 22142791');

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'age' => 25,
            'role' => 'admin',
            'password' => Hash::make('admin123'), // hashed
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};