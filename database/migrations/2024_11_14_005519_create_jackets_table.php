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
        Schema::create('jackets', function (Blueprint $table) {
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
                  $table->string('jacket_type');
                  $table->string('jacket_construction');
                  $table->string('jacket_lapel_type');
                  $table->string('jacket_hand_stitch');
                  $table->string('jacket_satin_lapel');
                  $table->string('jacket_lapel_width');
                  $table->string('jacket_lapel_functional_button');
                  $table->string('jacket_sleeve_buttons');
                  $table->string('jacket_functional_buttons');
                  $table->string('jacket_buttons_colour_on_last_button_hole');
                  $table->string('jacket_lining');
                  $table->string('jacket_pockets');
                  $table->string('jacket_pockets_with_flap');
                  $table->string('jacket_italian_pockets');
                  $table->string('jacket_patch_pockets');
                  $table->string('jacket_pockets_satin_piping');
                  $table->string('jacket_chest_pocket_type');
                  $table->string('jacket_vents');
                  $table->string('code_jacket');
                  $table->string('code_jacket_lining');
                  $table->string('code_jacket_button');
                  $table->string('code_satin_lapel')->nullable();
                  $table->string('code_colour_on_last_button_hole')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jackets');
    }
};
