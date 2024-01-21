<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserControlPoint extends Model
{
    use HasFactory;

    protected $table = 'user_control_points';
    protected $guarded = false;
}
