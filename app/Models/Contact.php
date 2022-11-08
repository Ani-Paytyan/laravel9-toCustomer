<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'contacts';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'company_id',
        'email',
        'role',
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'zip',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function workplaces()
    {
        return $this->belongsToMany(WorkPlace::class, 'work_place_contacts', 'contact_id', 'workplace_id')->withPivot('uuid');
    }

    public function uniqueItems()
    {
        return $this->belongsToMany(UniqueItem::class, 'unique_item_contacts', 'contact_id', 'unique_item_id')->withPivot('uuid');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_contacts', 'contact_id', 'team_id')->withPivot('uuid');
    }
}
