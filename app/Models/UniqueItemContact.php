<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniqueItemContact extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'unique_item_contacts';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'contact_id',
        'unique_item_id',
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
}
