<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    protected $table = 'department_users';

    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }
}
