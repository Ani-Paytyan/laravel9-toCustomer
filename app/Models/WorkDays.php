<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WorkDays
 *
 * @property string $uuid
 * @property string|null $company_id
 * @property string|null $workplace_id
 * @property int $day_of_week
 * @property string $from
 * @property string $to
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WorkDaysFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDays whereWorkplaceId($value)
 * @mixin \Eloquent
 */
class WorkDays extends Model
{
    use HasFactory;

    public const MONDAY = 1;
    public const TUESDAY = 2;
    public const WEDNESDAY = 3;
    public const THURSDAY = 4;
    public const FRIDAY = 5;
    public const SATURDAY = 6;
    public const SUNDAY = 7;

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

    /**
     * @return array
     */
    public static function getDays(): array
    {
        return [
            self::MONDAY => __('attributes.days.monday'),
            self::TUESDAY => __('attributes.days.tuesday'),
            self::WEDNESDAY => __('attributes.days.wednesday'),
            self::THURSDAY => __('attributes.days.thursday'),
            self::FRIDAY => __('attributes.days.friday'),
            self::SATURDAY => __('attributes.days.saturday'),
            self::SUNDAY => __('attributes.days.sunday'),
        ];
    }
}
