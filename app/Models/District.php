<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $guarded = false;

    public function control_points()
    {
        return $this->hasMany(ControlPoint::class, 'district_id');
    }
}
