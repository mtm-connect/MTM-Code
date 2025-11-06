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
        Schema::create('waistcoat', function (Blueprint $table) {
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
            $table->string('waistcoat_type');
            $table->string('code_waistcoat');
            $table->string('code_waistcoat_buttons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waistcoat');
    }
};
