<?php

namespace App\Services;

use App\Repositories\ReportRepository;
use Exception;

class ReportService
{
    protected ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function fields() : array
    {
        try {
            $data = $this->reportRepository->fields();
            return ['data' => $data, 'code' => 200];
        }
        catch (Exception $exception)
        {
            return ['message' => $exception->getMessage(), 'code' => 500];
        }

    }
}
