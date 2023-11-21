<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'branch_id',
        'created_by',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'id', 'branch_id');
    }
}
