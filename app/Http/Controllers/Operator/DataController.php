<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\StorePointRequest;
use App\Models\ControlPoint;
use App\Models\District;
use App\Models\Lake;
use App\Models\Point;
use App\Services\Operator\PointService;
use Illuminate\Http\Request;

class DataController extends Controller
{
    protected PointService $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function index()
    {
        $points = Point::all();
        return view('operator.data.index', compact('points'));
    }

    public function create()
    {
        $lakes = Lake::all();
        return view('operator.data.create', compact('lakes'));
    }

    public function store(StorePointRequest $request)
    {
        $data = $request->validated();
        $result = $this->pointService->store($data, auth()->user()->id);
        return response(['message' => $result['message']])->setStatusCode($result['status']);
    }
}
