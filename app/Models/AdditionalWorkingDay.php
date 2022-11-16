<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdditionalWorkingDay
 *
 * @property string $uuid
 * @property string $date
 * @property string $from
 * @property string $to
 * @property string|null $workplace_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalWorkingDay whereWorkplaceId($value)
 * @mixin \Eloquent
 */
class AdditionalWorkingDay extends Model
{
    use HasFactory;

    public $table = 'additional_working_days';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'workplace_id',
        'date',
        'from',
        'to',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
