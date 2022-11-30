<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Item
 *
 * @property string $uuid
 * @property string $name
 * @property string|null $serial_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Query\Builder|Item onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Item withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Item withoutTrashed()
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'items';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'name',
        'serial_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
