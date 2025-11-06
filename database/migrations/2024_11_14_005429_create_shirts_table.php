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
        Schema::create('shirts', function (Blueprint $table) {
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
            $table->string('collar');
            $table->string('collar_buttons');
            $table->string('collar_button_down');
            $table->string('cuff');
            $table->string('contrast');
            $table->string('placket');
            $table->string('pleat');
            $table->string('bottom');
            $table->string('pocket');
            $table->string('fit');
            $table->string('shirt_fabric_code');
            $table->string('shirt_button_code');
            $table->string('shirt_contrast_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shirts');
    }
};
