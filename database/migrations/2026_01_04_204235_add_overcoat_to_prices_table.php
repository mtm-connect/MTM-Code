<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('prices')->insert([
            'product'     => 'Overcoat',
            'price'       => 345,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('prices')
            ->where('product', 'Overcoat')
            ->delete();
    }
};
