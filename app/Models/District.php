<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $guarded = false;

    public function control_points(): HasMany
    {
        return $this->hasMany(ControlPoint::class, 'district_id');
    }

    public function lake(): BelongsTo
    {
        return $this->belongsTo(Lake::class);
    }
}
