<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\StorePointRequest;
use App\Models\ControlPoint;
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
        return view('operator.data.index');
    }

    public function create()
    {

        $control_point = ControlPoint::where('id', session('control_point'))->first();
        return view('operator.data.create', compact('control_point'));
    }

    public function store(StorePointRequest $request)
    {
        $data = $request->validated();
        $result = $this->pointService->store($data, auth()->user()->id);
        return response(['message' => $result['message']])->setStatusCode($result['status']);
    }
}
