<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Holiday
 *
 * @property string $uuid
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday query()
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Holiday whereUuid($value)
 * @mixin \Eloquent
 */
class Holiday extends Model
{
    use HasFactory;

    public $table = 'holidays';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'date',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
