<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService
{
    protected ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function fields()
    {
        $data = $this->reportRepository->fields();
        dd($data);
    }
}
