<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlPoint extends Model
{
    use HasFactory;

    protected $table = 'control_points';
    protected $guarded = false;
}
