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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')    // Foreign key column
                  ->constrained('users')    // References 'id' column on 'users' table
                  ->onDelete('cascade');  
            $table->string('name');
            $table->string('phone_number', 15);
            $table->string('email');
            $table->string('country');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();;
            $table->string('post_code');
            $table->string('county');
            $table->string('occasion');
            $table->date('date_required');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
