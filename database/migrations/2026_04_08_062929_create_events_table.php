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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('banner')->nullable();
            $table->string('category')->default('Umum'); // Musik, Seminar, dll.
            $table->string('location');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->integer('quota')->default(0);
            $table->decimal('price', 15, 2)->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Organizer/Admin pencipta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
