<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WorkPlace
 *
 * @property string $uuid
 * @property string $company_id
 * @property string $name
 * @property string|null $address
 * @property string|null $zip
 * @property string|null $number
 * @property string|null $city
 * @property string|null $status
 * @property string|null $sum_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AdditionalWorkingDay|null $additionalWorkingDays
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace newQuery()
 * @method static \Illuminate\Database\Query\Builder|WorkPlace onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereSumPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkPlace whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|WorkPlace withTrashed()
 * @method static \Illuminate\Database\Query\Builder|WorkPlace withoutTrashed()
 * @mixin \Eloquent
 */
class WorkPlace extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'workplaces';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'company_id',
        'name',
        'address',
        'zip',
        'number',
        'city',
        'status',
        'sum_price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'work_place_contacts', 'workplace_id', 'contact_id')->withPivot('uuid');
    }

    public function additionalWorkingDays()
    {
        return $this->belongsTo(AdditionalWorkingDay::class, 'uuid', 'workplace_id');
    }
}
