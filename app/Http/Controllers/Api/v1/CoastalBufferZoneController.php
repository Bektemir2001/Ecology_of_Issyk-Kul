<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HorizontalBufferZoneRequest;
use App\Http\Resources\HorizontalBufferZoneResource;
use App\Models\District;
use App\Services\BufferZoneServices;
use App\Services\TrophicLevelIndexService;
use http\Env\Response;
use Illuminate\Http\Request;

class CoastalBufferZoneController extends Controller
{
    protected BufferZoneServices $bufferZoneServices;
    protected TrophicLevelIndexService $tliService;
    public function __construct(BufferZoneServices $bufferZoneServices, TrophicLevelIndexService $tliService)
    {
        $this->bufferZoneServices = $bufferZoneServices;
        $this->tliService = $tliService;
    }

    public function horizontalCalculation(HorizontalBufferZoneRequest $request)
    {
        $data = $request->validated();
        $tli = $this->tliService->getDistrictTLI($data['year']);
        $result = $this->bufferZoneServices->horizontalCalculate($tli, $data['year'], $data['district'], $data['cost']);
        if($result['code'] == 200)
        {
            return response(['data' => $result['result']])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }
        elseif ($result['code'] == 404)
        {
            return response(['data' => [$result['result']]])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }

        return response(['message' => $result['message']])->setStatusCode($result['code'])
            ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
