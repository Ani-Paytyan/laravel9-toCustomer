<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkPlaceContact extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'work_place_contacts';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'contact_id',
        'workplace_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    /**
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'uuid');
    }

    /**
     * @return BelongsTo
     */
    public function workPlace(): BelongsTo
    {
        return $this->belongsTo(WorkPlace::class, 'workplace_id', 'uuid');
    }
}
