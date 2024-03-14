<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HorizontalBufferZoneRequest;
use App\Models\District;
use App\Services\BufferZoneServices;
use App\Services\TrophicLevelIndexService;
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
        $tli = $this->tliService->getDistrictTLI($data['year'], $data['district']);
        $result = $this->bufferZoneServices->horizontalCalculate($tli, $data['year'], $data['district'], $data['cost']);
        dd($result);
    }
}
