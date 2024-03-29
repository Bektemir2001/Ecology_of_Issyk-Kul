<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlPoint extends Model
{
    use HasFactory;

    protected $table = 'control_points';
    protected $guarded = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_control_points');
    }
}
