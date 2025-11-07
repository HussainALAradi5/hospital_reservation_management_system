<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
    $table->id();
    $table->string('code');
    $table->string('name');
    $table->enum('type', ['doctor_season', 'treatment'])->default('doctor_season');
    $table->enum('status', ['free', 'occupied', 'maintenance'])->default('free');
    $table->foreignId('hospital_id')->constrained()->onDelete('cascade');

    $table->json('medical_staff_ids')->nullable();
    $table->json('last_sign_in_user_ids')->nullable();
    $table->json('sign_out_user_ids')->nullable();

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};