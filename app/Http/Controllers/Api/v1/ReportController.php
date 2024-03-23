<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function getFields()
    {
        $result = $this->reportService->fields();
        if($result['code'] == 200)
        {
            return response($result);
        }
        return response($result)->setStatusCode($result['code']);
    }

    public function getData(ReportRequest $request)
    {
        $data = $request->validated();
        $result = $this->reportService->getData($data);
        if($result['code'] == 200)
        {
            return response($result);
        }
        return response($result)->setStatusCode($result['code']);
    }
}
