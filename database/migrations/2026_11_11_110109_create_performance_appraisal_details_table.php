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
        Schema::create('performance_appraisal_details', function (Blueprint $table) {
            $table->uuid('id_performance_detail')->primary();
            $table->foreignUuid('performance_id')->constrained('performance_appraisals', 'id_performance')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('kpi_id')->constrained('kpi_indicators', 'id_kpi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('score');
            $table->decimal('weight_snapshot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_appraisal_details');
    }
};
