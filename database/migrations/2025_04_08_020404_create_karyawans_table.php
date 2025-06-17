<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
    Schema::create('karyawans', function (Blueprint $table) {
        $table->id();
        $table->string('ktp')->unique();
        $table->string('nama');
        $table->string('jk');
        $table->string('jabatan');
        $table->string('nohp');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
