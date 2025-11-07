<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('quantity');
            $table->integer('number_of_days');

            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->foreignId('writen_by_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('writed_for_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_descriptions');
    }
};