<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $table = 'elements';
    protected $guarded = false;

    public function children()
    {
        return $this->hasMany(Element::class, 'parent');
    }

    public function parentElement()
    {
        return $this->belongsTo(Element::class, 'parent');
    }

    public function intervalTrophicLevelIndex()
    {
        return $this->hasMany(IntervalTrophicLevelIndexForElement::class, 'element_id', 'id');
    }

    public function trophicLevelIndex()
    {
        return $this->belongsToMany(TrophicLevelIndex::class, 'interval_trophic_level_index_for_elements', 'element_id', 't_index_id');
    }
    public function trophicStateIndex()
    {
        return $this->belongsToMany(TrophicStateIndex::class, 'trophic_state_index_for_elements', 'element_id', 't_index_id');
    }
}
