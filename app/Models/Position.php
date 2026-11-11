<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_position';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'position',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'position_id', 'id_position');
    }
}
