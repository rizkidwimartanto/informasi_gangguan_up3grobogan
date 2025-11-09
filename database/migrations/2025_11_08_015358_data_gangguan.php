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
        Schema::create('data_gangguan', function (Blueprint $table) {
            $table->id();
            $table->string('nihil')->nullable();
            $table->string('penyulang')->nullable();
            $table->string('keypoint')->nullable();
            $table->string('jumlah_trafo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_gangguan');
    }
};
