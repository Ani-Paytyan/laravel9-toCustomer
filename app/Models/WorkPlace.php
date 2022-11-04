<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkPlace extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'workplaces';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'company_id',
        'name',
        'address',
        'zip',
        'number',
        'city',
        'status',
        'sum_price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'work_place_contacts', 'workplace_id', 'contact_id')->withPivot('uuid');
    }

    public function additionalWorkingDays()
    {
        return $this->belongsTo(AdditionalWorkingDay::class, 'uuid', 'workplace_id');
    }
}
