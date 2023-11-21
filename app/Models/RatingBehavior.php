<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingBehavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'department_id',
        'sub_department_id',
        'employee_id',
        'behavior_id',
        'score',
        'created_by',
    ];

    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    public function sub_department()
    {
        return $this->hasOne('App\Models\SubDepartment', 'id', 'sub_department_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    public function behavior()
    {
        return $this->hasOne('App\Models\Behavior', 'id', 'behavior_id');
    }
}
