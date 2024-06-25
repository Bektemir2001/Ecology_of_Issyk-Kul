<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\TrophicStateIndexService;
use App\Services\TSIService;
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

        try {
            $result = $this->trophicStateIndexService->getTSI($year, $district);
            return response(['elements' => $result[0], 'control_points' => $result[1]]);
        }
        catch (\Exception $e)
        {
            return response(['elements' => [], 'control_points' => []]);
        }
    }

	public function getTSIPoints(string $year)
	{
		try {
			$result = $this->trophicStateIndexService->getTSIPoint($year);
			$result = TSIService::calculateClassification($result[0], $result[1]);
			return response(['data' => $result]);
		}
		catch (\Exception $e)
		{
			return response(['elements' => [], 'control_points' => []]);
		}
	}
}
