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
    Schema::create('warehouses', function (Blueprint $table) {
        $table->id();
        $table->string('code_no')->unique();
        $table->string('status'); // Active, Sold, Reserved
        $table->decimal('selling_price', 15, 2);
        $table->decimal('last_price', 15, 2);
        $table->string('price_type'); // Net or Gross
        $table->string('commission');

        // Contact Info
        $table->string('owner_name');
        $table->string('owner_contact');
        $table->string('contact_person')->nullable();
        $table->string('cp_number')->nullable();
        $table->string('email')->nullable();
        $table->string('fb_link')->nullable();
        $table->string('referrer_agent')->nullable();

        // Property Specs
        $table->text('exact_address');
        $table->string('vicinity');
        $table->string('city_municipality');
        $table->double('lot_area');
        $table->double('floor_area');
        $table->text('description'); // Furnished/Bare
        $table->string('condition'); // Brand New/Pre-owned

        // Payment Terms
        $table->string('payment_mode');
        $table->decimal('reservation_fee', 15, 2);
        $table->decimal('downpayment', 15, 2);
        $table->integer('dp_terms');
        $table->text('inclusions'); // Seller expense
        $table->text('buyer_expense');
        $table->decimal('move_in_fee', 15, 2);
        $table->decimal('misc_fees', 15, 2);

        // Media & Notes
        $table->text('remarks')->nullable();
        $table->string('ext_photos')->nullable();
        $table->string('int_photos')->nullable();
        $table->string('v_videos')->nullable();
        $table->string('h_videos')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};