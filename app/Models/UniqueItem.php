<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniqueItem extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'unique_items';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'item_id',
        'workplace_id',
        'name',
        'article',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'uuid' => 'string'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'uuid');
    }

    public function workPlace()
    {
        return $this->belongsTo(WorkPlace::class, 'workplace_id', 'uuid');
    }
}
