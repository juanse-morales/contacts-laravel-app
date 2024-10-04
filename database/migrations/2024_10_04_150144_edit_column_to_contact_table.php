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
        Schema::table('contact', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->nullable()->change();
            $table->boolean('is_deleted')->default(false)->nullable()->change();
            $table->boolean('is_archived')->default(false)->nullable()->change();
            $table->boolean('is_blocked')->default(false)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            //
        });
    }
};
