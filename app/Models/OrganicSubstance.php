<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganicSubstance extends Model
{
    use HasFactory;

    protected $table = 'organic_substances';
    protected $guarded = false;
}
