<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\EarthTransformationIndicatorService;

class TransformationIndicatorController extends Controller
{
    private EarthTransformationIndicatorService $earthTransformationIndicatorService;

    public function __construct(EarthTransformationIndicatorService $earthTransformationIndicatorService)
    {
        $this->earthTransformationIndicatorService = $earthTransformationIndicatorService;
    }

    public function getData(District $district, string $year)
    {
        return response(['data' => $this->earthTransformationIndicatorService->getData($district, $year)]);
    }
}
