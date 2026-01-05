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
        Schema::create('overcoats', function (Blueprint $table) {
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

            $table->string('overcoat_type');
            $table->string('overcoat_construction');
            $table->string('overcoat_lapel_type');
            $table->string('overcoat_hand_stitch');
            $table->string('overcoat_satin_lapel');
            $table->string('overcoat_lapel_width');
            $table->string('overcoat_lapel_functional_button');
            $table->string('overcoat_sleeve_buttons');
            $table->string('overcoat_functional_buttons');
            $table->string('overcoat_buttons_colour_on_last_button_hole');
            $table->string('overcoat_lining');
            $table->string('overcoat_pockets');
            $table->string('overcoat_pockets_with_flap');
            $table->string('overcoat_italian_pockets');
            $table->string('overcoat_patch_pockets');
            $table->string('overcoat_pockets_satin_piping');
            $table->string('overcoat_chest_pocket_type');
            $table->string('overcoat_vents');
            $table->string('code_overcoat');
            $table->string('code_overcoat_lining');
            $table->string('code_overcoat_button');
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
        Schema::dropIfExists('overcoats');
    }
};
