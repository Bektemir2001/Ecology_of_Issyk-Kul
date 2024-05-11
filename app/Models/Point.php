<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Point extends Model
{
    use HasFactory;

    protected $table = 'points';
    protected $guarded = false;

    public function controlPoint(): BelongsTo
    {
        return $this->belongsTo(ControlPoint::class);
    }

    public function elements(): BelongsToMany
    {
        return $this->belongsToMany(Element::class, 'point_elements', 'point_id', 'element_id');
    }
    public function pointElements(): HasMany
    {
        return $this->hasMany(PointElement::class);
    }

    public function pointIons(): HasMany
    {
        return $this->hasMany(PointMajorIon::class);
    }

    public function pointOrganics(): HasMany
    {
        return $this->hasMany(PointOrganicSubstance::class);
    }

    public function ions(): BelongsToMany
    {
        return $this->belongsToMany(MajorIon::class, 'point_major_ions', 'point_id', 'ion_id');
    }
    public function organic_substances(): BelongsToMany
    {
        return $this->belongsToMany(OrganicSubstance::class, 'point_organic_substances', 'point_id', 'organic_substance_id');
    }

}
