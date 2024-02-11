<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrophicLevelIndex extends Model
{
    use HasFactory;

    protected $table = 'trophic_level_indices';
    protected $guarded = false;
}
