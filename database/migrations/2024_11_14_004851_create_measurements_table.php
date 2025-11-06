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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')    // Foreign key column
                  ->constrained('orders')    // References 'id' column on 'users' table
                  ->onDelete('cascade'); 
                  $table->foreignId('user_id')    // Foreign key column
                  ->constrained('users')    // References 'id' column on 'users' table
                  ->onDelete('cascade');  
            $table->string('name');
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female']);
            $table->integer('height');
            $table->integer('weight');
            $table->integer('shoulders');
            $table->integer('sleeve_length');
            $table->integer('bicep');
            $table->integer('wrist');
            $table->integer('chest');
            $table->integer('belly');
            $table->integer('waist');
            $table->integer('hip');
            $table->integer('thigh');
            $table->integer('knee');
            $table->integer('cuff');
            $table->integer('outside_leg_length');
            $table->integer('neck');
            $table->integer('crotch')->nullable();
            $table->integer('inside_leg_length')->nullable();
            $table->integer('inside_sleeve_length')->nullable();
            $table->integer('pants_cuff_width')->nullable();
            $table->integer('jacket_length_front')->nullable();
            $table->string('bs_shoulders');
            $table->string('bs_chest');
            $table->string('bs_stomach');
            $table->string('bs_posture');
            $table->string('bs_seat');
            $table->string('special_requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
