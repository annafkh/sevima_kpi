<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('kpi_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_category_id')->constrained('kpi_categories')->onDelete('cascade'); // Relasi ke kategori KPI
            $table->string('nama'); // Nama indikator KPI
            $table->integer('bobot'); // Bobot indikator KPI
            $table->integer('target'); // Target nilai KPI
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_indicators');
    }
};
