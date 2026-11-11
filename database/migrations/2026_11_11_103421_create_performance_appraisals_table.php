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
        Schema::create('performance_appraisals', function (Blueprint $table) {
            $table->uuid('id_performance')->primary();
            $table->string('nik_id');
            $table->foreign('nik_id')->references('nik')
                ->on('employees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('evaluator_id')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('category_id')->constrained('performance_categories', 'id_category')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('period');
            $table->decimal('final_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_appraisals');
    }
};
