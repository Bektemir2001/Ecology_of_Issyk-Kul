<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lake extends Model
{
    use HasFactory;

    protected $table = 'lakes';
    protected $guarded = false;

    public function districts()
    {
        return $this->hasMany(District::class, 'lake_id');
    }
}
