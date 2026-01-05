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
        Schema::table('order_overview', function (Blueprint $table) {
            $table->foreignId('overcoat_id')
                ->nullable()
                ->after('waistcoat_id')
                ->constrained('overcoats')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_overview', function (Blueprint $table) {
            $table->dropForeign(['overcoat_id']);
            $table->dropColumn('overcoat_id');
        });
    }
};
