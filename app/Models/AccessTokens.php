<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccessTokens
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens query()
 * @mixin \Eloquent
 * @property string $uuid
 * @property string $user_id
 * @property string $user_data
 * @property string $token
 * @property string|null $push_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens wherePushToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens whereUserData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessTokens whereUuid($value)
 */
class AccessTokens extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'user_id',
        'user_data',
        'token',
        'push_token',
        'last_use_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
