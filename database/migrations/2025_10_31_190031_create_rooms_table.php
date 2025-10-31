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
            $table->enum('type', ['doctor_season', 'treatment'])->default('treatment');
            $table->integer('capacity');
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['free', 'occupied', 'maintenance'])->default('free');
            $table->foreignId('medical_staff_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};