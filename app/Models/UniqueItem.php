<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UniqueItem
 *
 * @property string $uuid
 * @property string $item_id
 * @property string $workplace_id
 * @property string|null $name
 * @property string|null $article
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\WorkPlace $workPlace
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|UniqueItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueItem whereWorkplaceId($value)
 * @method static \Illuminate\Database\Query\Builder|UniqueItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UniqueItem withoutTrashed()
 * @mixin \Eloquent
 */
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
        'mac',
        'article',
        'is_inside',
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

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'unique_item_contacts', 'unique_item_id', 'contact_id')->withPivot('uuid');
    }
}
