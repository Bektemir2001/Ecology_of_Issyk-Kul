<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrophicStateIndexForElement extends Model
{
    use HasFactory;
    protected $table = 'trophic_state_index_for_elements';
    protected  $guarded = false;

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
