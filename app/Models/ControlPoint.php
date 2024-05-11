<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlPoint extends Model
{
    use HasFactory;

    protected $table = 'control_points';
    protected $guarded = false;


    public string $color = "#000";
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_control_points');
    }

    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }
}
