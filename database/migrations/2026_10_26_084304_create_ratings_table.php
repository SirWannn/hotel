<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reservasi_id')
                ->unique()
                ->constrained('reservasis')
                ->cascadeOnDelete();

            $table->foreignId('tamu_id')
                ->constrained('tamus')
                ->cascadeOnDelete();

            $table->foreignId('kamar_id')
                ->constrained('kamars')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('rating');

            $table->text('ulasan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};