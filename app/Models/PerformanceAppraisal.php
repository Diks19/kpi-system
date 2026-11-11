<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerformanceAppraisal extends Model
{
    /** @use HasFactory<\Database\Factories\PerformanceAppraisalFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_performance';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = ['id_performance'];

    protected function casts(): array
    {
        return [
            'period' => 'date',
            'final_score' => 'decimal:2',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'nik_id', 'nik');
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PerformanceCategory::class, 'category_id', 'id_category');
    }

    public function details(): HasMany
    {
        return $this->hasMany(PerformanceAppraisalDetail::class, 'performance_id', 'id_performance');
    }
}
