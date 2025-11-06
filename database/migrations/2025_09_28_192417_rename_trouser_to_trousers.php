<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('trouser', 'trousers');
    }
    public function down(): void
    {
        Schema::rename('trousers', 'trouser');
    }
};

