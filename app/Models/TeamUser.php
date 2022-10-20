<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamUser extends Model
{
    use HasFactory, SoftDeletes;

    public const ROLE_LEAD = 'Lead';
    public const ROLE_MEMBER = 'Member';

    public $table = 'team_users';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'user_id',
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
}
