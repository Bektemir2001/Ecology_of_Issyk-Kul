<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrophicStateIndex extends Model
{
    use HasFactory;
    protected $table = 'trophic_state_indices';
    protected $guarded = false;

    public function elementIndeces()
    {
        return $this->hasMany(IntervalTrophicLevelIndexForElement::class, 't_index_id', 'id');
    }
}
