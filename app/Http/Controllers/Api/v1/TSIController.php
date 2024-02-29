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

    }
}
