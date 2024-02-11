<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ControlPointResource;
use App\Http\Resources\GeneralResource;
use App\Models\ControlPoint;
use Illuminate\Http\Request;

class ControlPointController extends Controller
{
    public function getAll()
    {
        return ControlPointResource::collection(ControlPoint::all());
    }
}
