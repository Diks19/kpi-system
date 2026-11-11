<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceAppraisalDetail extends Model
{
    /** @use HasFactory<\Database\Factories\PerformanceAppraisalDetailFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_performance_detail';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [
        'id_performance_detail',
    ];

    public function performanceAppraisal(): BelongsTo
    {
        return $this->belongsTo(
            PerformanceAppraisal::class,
            'performance_id',
            'id_performance'
        );
    }

    public function kpiIndicator(): BelongsTo
    {
        return $this->belongsTo(
            KpiIndicator::class,
            'kpi_id',
            'id_kpi'
        );
    }
}
