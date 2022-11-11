<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'teams';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'company_id',
        'name',
        'description',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'team_contacts', 'team_id', 'contact_id')
            ->withPivot('uuid')
            ->wherePivot('deleted_at', '=', null);
    }
}
