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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('code', 50)->unique();

        $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
        $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('room_id')->constrained()->onDelete('cascade');

        $table->date('appointment_date');
        $table->time('appointment_time');

        $table->enum('status', ['pending', 'arrived', 'done', 'absent'])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointemnts');
    }
};
