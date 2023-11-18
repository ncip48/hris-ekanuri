<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'created_by',
    ];

    public function level()
    {
        return $this->hasOne('App\Models\Level', 'id', 'level_id');
    }
}
