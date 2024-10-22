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
        Schema::table('contact_photo', function (Blueprint $table) {
            $table->enum('operation', ['created', 'updated', 'deleted'])->default('created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_photo', function (Blueprint $table) {
            $table->dropColumn('operation');
        });
    }
};
