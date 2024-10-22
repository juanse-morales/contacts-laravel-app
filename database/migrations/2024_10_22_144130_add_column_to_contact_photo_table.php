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
            $table->dropColumn('filename');
            $table->string('original_filename', 100)->default('contact_photo');
            $table->string('new_filename', 100)->default('CONTACTPHOTO');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_photo', function (Blueprint $table) {
            $table->string('filename', 100)->change();
        });
    }
};
