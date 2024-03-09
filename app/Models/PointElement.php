<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointElement extends Model
{
    use HasFactory;

    protected $table = 'point_elements';
    protected $guarded = false;
    protected $with = ['element'];

    public function element()
    {
        return $this->belongsTo(Element::class, 'element_id')->select('id', 'name', 'TLI_formula', 'TSI_formula');
    }
}
