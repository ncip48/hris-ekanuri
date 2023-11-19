<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'branch_id',
        'department_id',
        'sub_department_id',
        'designation_id',
        'report',
        'created_by',
    ];
}
