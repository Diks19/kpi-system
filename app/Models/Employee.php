<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $primaryKey = 'nik';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nik',
        'department_id',
        'position_id',
        'name'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id_department');
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id_position');
    }
    public function performanceAppraisals(): HasMany

    {
        return $this->hasMany(PerformanceAppraisal::class, 'nik_id', 'nik');
    }
}
