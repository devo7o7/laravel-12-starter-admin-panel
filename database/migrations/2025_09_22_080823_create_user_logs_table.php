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
       Schema::create('user_logs', function (Blueprint $table) {
    $table->id();
    $table->string('user_id')->nullable(); // instead of unsignedBigInteger
    $table->string('email')->nullable();
    $table->string('name')->nullable();
    $table->string('mobile')->nullable();
    $table->string('action')->nullable(); // e.g., login, logout, page_view
    $table->json('meta')->nullable();    // any extra data
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
