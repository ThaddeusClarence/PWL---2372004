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
        Schema::create('waiting_lists', function (Blueprint $user) {
            $user->id();
            $user->foreignId('event_id')->constrained()->onDelete('cascade');
            $user->foreignId('user_id')->constrained()->onDelete('cascade');
            $user->string('ticket_type_name')->nullable(); // Tipe tiket yang diinginkan
            $user->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_lists');
    }
};
