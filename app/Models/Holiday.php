<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    public $table = 'holidays';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'date',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
