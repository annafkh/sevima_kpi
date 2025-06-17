<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kpi_scores', function (Blueprint $table) {
            $table->text('feedback')->nullable(); // HAPUS: ->after('value')
        });
    }
    

    public function down(): void
    {
        Schema::table('kpi_scores', function (Blueprint $table) {
            $table->dropColumn('feedback');
        });
    }
};
