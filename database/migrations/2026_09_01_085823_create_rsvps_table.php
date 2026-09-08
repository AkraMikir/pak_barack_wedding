<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->enum('status_hadir', ['Hadir', 'Tidak'])->default('Hadir');
            $table->tinyInteger('jumlah_rombongan')->unsigned()->nullable();
            $table->text('wishes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};
