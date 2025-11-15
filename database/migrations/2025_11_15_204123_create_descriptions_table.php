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
    Schema::create('descriptions', function (Blueprint $table) {
        $table->id();
        $table->string('code', 50)->unique();
        $table->string('name');
        $table->text('description')->nullable();

        $table->enum('description_type', ['medicine', 'treatment']);
        $table->enum('status', ['pending', 'in_progress', 'done'])->default('pending');
        $table->date('date_written')->nullable();

        $table->foreignId('written_by_user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('written_for_user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('hospital_id')->nullable()->constrained()->onDelete('cascade');

        $table->foreignId('medicine_id')->nullable()->constrained()->onDelete('cascade');
        $table->integer('quantity')->nullable();
        $table->integer('number_of_days')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions');
    }
};
