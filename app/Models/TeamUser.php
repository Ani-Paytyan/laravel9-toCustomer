<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamUser extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'team_users';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'team_id',
        'name',
        'role',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
