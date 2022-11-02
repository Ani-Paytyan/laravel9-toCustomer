<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
