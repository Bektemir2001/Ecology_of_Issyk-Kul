<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ControlPoint\StoreRequest;
use App\Http\Requests\Admin\ControlPoint\UpdateRequest;
use App\Models\ControlPoint;
use App\Models\Lake;
use App\Services\ControlPointService;
use Illuminate\Http\Request;

class ControlPointController extends Controller
{
    protected ControlPointService $controlPointService;

    public function __construct(ControlPointService $controlPointService)
    {
        $this->controlPointService = $controlPointService;
    }

    public function index()
    {
        $data = ControlPoint::all();
        $create_route = "admin.control_points.create";
        $title = "Control Points";
        $key = 'control_points';
        return view('admin.control_point.index', compact('data', 'create_route', 'title', 'key'));
    }
    public function show(ControlPoint $controlPoint)
    {
        return view('admin.control_point.show', compact(['item' => $controlPoint]));
    }

    public function create()
    {
        $lakes = Lake::all();
        return view('admin.control_point.create', compact('lakes'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->controlPointService->store($data);
        return redirect()->route('admin.control_points.index')->with(['notification' => $result['message']]);
    }

    public function edit(ControlPoint $controlPoint)
    {
        $lakes = Lake::all();
        return view('admin.control_point.edit', ['item' => $controlPoint, 'lakes' => $lakes]);
    }

    public function update(UpdateRequest $request, ControlPoint $controlPoint)
    {
        $data = $request->validated();
        $result = $this->controlPointService->update($data, $controlPoint);
        return redirect()->route('admin.control_points.index')->with(['notification' => $result['message']]);
    }
    public function delete()
    {

    }
}
