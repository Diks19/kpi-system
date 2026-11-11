<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerformanceCategory extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_category';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'category_name',
        'minimum_score',
        'maximum_score',
        'color'
    ];

    protected function casts(): array
    {
        return [
            'minimum_score' => 'decimal:2',
            'maximum_score' => 'decimal:2',
        ];
    }

    public function performanceAppraisals(): HasMany
    {
        return $this->hasMany(PerformanceAppraisal::class, 'category_id', 'id_category');
    }
}
