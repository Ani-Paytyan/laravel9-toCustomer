<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
