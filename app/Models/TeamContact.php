<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TeamContact
 *
 * @property string $uuid
 * @property string $contact_id
 * @property string $team_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact newQuery()
 * @method static \Illuminate\Database\Query\Builder|TeamContact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamContact whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|TeamContact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TeamContact withoutTrashed()
 * @mixin \Eloquent
 */
class TeamContact extends Model
{
    use HasFactory, SoftDeletes;

    public const ROLE_LEAD = 'Lead';
    public const ROLE_MEMBER = 'Member';

    public $table = 'team_contacts';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'contact_id',
        'team_id',
        'name',
        'role',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public static function getRoles()
    {
        return [
            self::ROLE_LEAD => self::ROLE_LEAD,
            self::ROLE_MEMBER => self::ROLE_MEMBER,
        ];
    }

    public function contact()
    {
        return $this->hasOne(Contact::class, 'uuid', 'contact_id');
    }

    public function team()
    {
       return $this->belongsTo(Team::class, 'team_id', 'uuid');
    }
}
