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
        Schema::create('order_overview', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');
    
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
    
            $table->foreignId('measurement_id')
                ->constrained('measurements')
                ->onDelete('cascade');
    
            $table->foreignId('price_id')
                ->constrained('prices')
                ->onDelete('restrict');
    
            $table->foreignId('two_pieces_id')
                ->nullable()
                ->constrained('two_pieces')
                ->onDelete('cascade');
    
            $table->foreignId('three_pieces_id')
                ->nullable()
                ->constrained('three_pieces')
                ->onDelete('cascade');
    
            $table->foreignId('jackets_id')
                ->nullable()
                ->constrained('jackets')
                ->onDelete('cascade');
    
            $table->foreignId('shirts_id')
                ->nullable()
                ->constrained('shirts')
                ->onDelete('cascade');
    
            // ✅ New additions
            $table->foreignId('trouser_id')
                ->nullable()
                ->constrained('trousers')
                ->onDelete('cascade');
    
            $table->foreignId('waistcoat_id')
                ->nullable()
                ->constrained('waistcoats')
                ->onDelete('cascade');
    
            $table->string('type');
            $table->string('for');
            $table->integer('price');
            $table->string('status');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_overview');
    }
};
