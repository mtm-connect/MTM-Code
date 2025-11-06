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
        Schema::create('trouser', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')    // Foreign key column
            ->constrained('orders')    // References 'id' column on 'users' table
            ->onDelete('cascade'); 
            $table->foreignId('user_id')    // Foreign key column
            ->constrained('users')    // References 'id' column on 'users' table
            ->onDelete('cascade'); 
            $table->foreignId('measurement_id')    // Foreign key column
            ->constrained('measurements')    // References 'id' column on 'measurements' table
            ->onDelete('cascade');
            $table->foreignId('price_id')    // Foreign key column
            ->constrained('prices')    // References 'id' column on 'prices' table
            ->onDelete('restrict');
            $table->string('pants_pocket');
            $table->string('pants_pleats');
            $table->string('pants_extended_waist_strap');
            $table->string('pants_side_adjusters');
            $table->string('pants_back_pocket_type');
            $table->string('pants_back_pocket_with_buttons');
            $table->string('pants_back_pocket_with_flap');
            $table->string('pants_pant_cuffs');
            $table->string('pants_satin_tape_on_side');
            $table->string('code_pants');
            $table->string('code_pants_button');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trouser');
    }
};
