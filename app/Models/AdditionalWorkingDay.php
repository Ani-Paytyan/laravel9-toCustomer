<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalWorkingDay extends Model
{
    use HasFactory;

    public $table = 'additional_working_days';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'workplace_id',
        'date',
        'from',
        'to',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
