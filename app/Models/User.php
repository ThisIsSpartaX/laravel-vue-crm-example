<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @property-read $id
 * @param string $name
 * @param string $email
 * @param string $password
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(
            Department::class,
            DepartmentUser::getTableName(),
            'user_id',
            'department_id'
        );
    }
}
