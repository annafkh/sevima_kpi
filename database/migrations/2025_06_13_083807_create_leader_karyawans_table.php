<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leader_karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_user_id');
            $table->unsignedBigInteger('karyawan_id');
            $table->timestamps();

            $table->foreign('leader_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leader_karyawans');
    }
};
