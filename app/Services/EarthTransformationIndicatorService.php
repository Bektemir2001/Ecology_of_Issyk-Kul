<?php

namespace App\Services;

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

}
