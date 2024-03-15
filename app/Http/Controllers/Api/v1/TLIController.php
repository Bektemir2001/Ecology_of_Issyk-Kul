<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\TrophicLevelIndexService;
use Illuminate\Http\Request;

class TLIController extends Controller
{
    protected TrophicLevelIndexService $trophicLevelIndexService;

    public function __construct(TrophicLevelIndexService $trophicLevelIndexService)
    {
        $this->trophicLevelIndexService = $trophicLevelIndexService;
    }

    public function index(string $year, District $district)
    {
        $result = $this->trophicLevelIndexService->getDistrictTLI($year, $district->id);

        return response(['elements' => $result[0], 'control_points' => $result[1]]);
    }
}
