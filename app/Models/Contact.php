<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Contact
 *
 * @property string $uuid
 * @property string $company_id
 * @property string $email
 * @property string $role
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UniqueItem[] $uniqueItems
 * @property-read int|null $unique_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkPlace[] $workplaces
 * @property-read int|null $workplaces_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Query\Builder|Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Contact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contact withoutTrashed()
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'contacts';

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'company_id',
        'email',
        'role',
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'zip',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function workplaces()
    {
        return $this->belongsToMany(WorkPlace::class, 'work_place_contacts', 'contact_id', 'workplace_id')
            ->withPivot('uuid')
            ->wherePivot('deleted_at', '=', null)
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }

    public function uniqueItems()
    {
        return $this->belongsToMany(UniqueItem::class, 'unique_item_contacts', 'contact_id', 'unique_item_id')
            ->withPivot('uuid')
            ->wherePivot('deleted_at', '=', null)
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_contacts', 'contact_id', 'team_id')
            ->withPivot('uuid', 'role')
            ->wherePivot('deleted_at', '=', null)
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }
}
