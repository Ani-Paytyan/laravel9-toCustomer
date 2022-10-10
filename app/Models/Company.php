<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'companies';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'name',
        'address',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
