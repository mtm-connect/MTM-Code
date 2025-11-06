<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->integer('price');
            $table->timestamps();
        });

        // Insert default records in correct order
        DB::table('prices')->insert([
            ['product' => '2 Piece',    'price' => 450, 'created_at' => now(), 'updated_at' => now()],
            ['product' => '3 Piece',    'price' => 600, 'created_at' => now(), 'updated_at' => now()],
            ['product' => 'Jacket',     'price' => 300, 'created_at' => now(), 'updated_at' => now()],
            ['product' => 'Shirt',      'price' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['product' => 'Trouser',    'price' => 200, 'created_at' => now(), 'updated_at' => now()],
            ['product' => 'Waistcoat',  'price' => 200, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
