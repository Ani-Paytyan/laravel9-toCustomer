<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDays extends Model
{
    use HasFactory;

    public $table = 'work_days';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'company_id',
        'workplace_id',
        'day_of_week',
        'from',
        'to',
        'is_active',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];
}
