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
    Schema::create('reservasis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tamu_id')->constrained('tamus')->onDelete('cascade');
        $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
        $table->date('check_in');
        $table->date('check_out');
        $table->string('status')->default('menunggu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
