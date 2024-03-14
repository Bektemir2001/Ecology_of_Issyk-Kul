<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarthTransformationIndicator extends Model
{
    use HasFactory;
    protected $table = 'earth_transformation_indicators';
    protected $guarded = false;

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
