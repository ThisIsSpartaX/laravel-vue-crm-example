<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Department
 *
 * @property-read int $id
 * @property string $name
 * @property string $description
 * @property string $logo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @package App\Models\Department
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department query()
 * @mixin \Eloquent
 */
class Department extends Model
{
    protected $table = 'departments';

    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }

    public static function getImageFolder(): string
    {
        return 'logo';
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            DepartmentUser::getTableName(),
            'department_id',
            'user_id'
        )->select([
            User::getTableName() . '.id',
            User::getTableName() . '.name'
        ]);
    }
}
