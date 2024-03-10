<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\TrophicStateIndexService;
use Illuminate\Http\Request;

class TSIController extends Controller
{

    protected TrophicStateIndexService $trophicStateIndexService;

    public function __construct(TrophicStateIndexService $trophicStateIndexService)
    {
        $this->trophicStateIndexService = $trophicStateIndexService;
    }

    public function index(string $year, District $district)
    {
        $result = $this->trophicStateIndexService->getTSI($year, $district);
        return response(['elements' => $result[0], 'control_points' => $result[1]]);

    }
}
