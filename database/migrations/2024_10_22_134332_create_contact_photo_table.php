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
        Schema::create('contact_photo', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 100)->default('contactphoto');
            $table->integer('contact_id')->default(0);
            $table->datetime('uploaded_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_contact');
    }
};
