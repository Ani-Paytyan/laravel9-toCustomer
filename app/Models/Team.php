<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Team
 *
 * @property string $uuid
 * @property string $company_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Query\Builder|Team onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Team withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Team withoutTrashed()
 * @mixin \Eloquent
 */
class Team extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'teams';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'company_id',
        'name',
        'description',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'team_contacts', 'team_id', 'contact_id')
            ->withPivot('uuid')
            ->wherePivot('deleted_at', '=', null);
    }
}
