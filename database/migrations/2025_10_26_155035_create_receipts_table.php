<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('receipt_number')->unique();
            $table->string('currency', 10)->default('GBP');
            $table->unsignedInteger('amount');      // store in minor units (e.g. pence)
            $table->unsignedInteger('tax_amount')->default(0);
            $table->string('pdf_path')->nullable(); // storage path
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('receipts'); }
};

