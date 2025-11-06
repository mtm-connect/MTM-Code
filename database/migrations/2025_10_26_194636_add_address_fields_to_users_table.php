<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->after('email');
            $table->string('address_line_1')->after('country');
            $table->string('address_line_2')->nullable()->after('address_line_1');
            $table->string('post_code')->after('address_line_2');
            $table->string('county')->after('post_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['country', 'address_line_1', 'address_line_2', 'post_code', 'county']);
        });
    }
};

