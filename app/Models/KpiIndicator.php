<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KpiIndicator extends Model
{
    /** @use HasFactory<\Database\Factories\KpiIndicatorFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_kpi';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [
        'id_kpi',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
        ];
    }

    public function appraisalDetails(): HasMany
    {
        return $this->hasMany(PerformanceAppraisalDetail::class, 'kpi_id', 'id_kpi');
    }
}
