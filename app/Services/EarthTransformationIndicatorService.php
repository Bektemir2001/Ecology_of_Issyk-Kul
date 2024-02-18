<?php

namespace App\Services;

use App\Models\District;
use App\Models\EarthTransformationIndicator;
use Exception;

class EarthTransformationIndicatorService extends Service
{

    public function store($data) : array
    {
        try{
            EarthTransformationIndicator::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function getData(District $district, string $year): array
    {
        $data = EarthTransformationIndicator::where('district_id', '=', $district->id)
                ->whereYear('date', '=', $year)
                ->get(['from_the_coast', 'area']);

        $formCostArray = $data->pluck('from_the_coast')->toArray();
        $areaArray = $data->pluck('area')->toArray();
        return ['distances' => $formCostArray, 'area' => $areaArray];
    }

}
