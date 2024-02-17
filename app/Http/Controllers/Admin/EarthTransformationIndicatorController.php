<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EarthTransformationIndicator\StoreRequest;
use App\Models\District;
use App\Models\EarthTransformationIndicator;
use App\Services\EarthTransformationIndicatorService;
use Illuminate\Http\Request;

class EarthTransformationIndicatorController extends Controller
{
    protected EarthTransformationIndicatorService $earthTransformationIndicatorService;

    public function __construct(EarthTransformationIndicatorService $earthTransformationIndicatorService)
    {
        $this->earthTransformationIndicatorService = $earthTransformationIndicatorService;
    }

    public function index()
    {
        $data = EarthTransformationIndicator::all();
        $create_route = "admin.earth.transformation.indicators.create";
        $title = "Earth Transformation Indicators";
        $key = 'earth.transformation.indicators';
        return view('admin.earth_transformation_indicator.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function show(EarthTransformationIndicator $earthTransformationIndicator)
    {
        return view('admin.earth_transformation_indicator.show', compact(['item' => $earthTransformationIndicator]));
    }

    public function create()
    {
        $districts = District::all();
        return view('admin.earth_transformation_indicator.create', compact('districts'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->earthTransformationIndicatorService->store($data);
        return redirect()->route('admin.earth.transformation.indicators.index')->with(['notification' => $result['message']]);
    }

    public function edit(EarthTransformationIndicator $earthTransformationIndicator)
    {
        return view('admin.earth_transformation_indicator.edit', compact(['item' => $earthTransformationIndicator]));
    }

    public function update()
    {

    }
    public function delete()
    {

    }

    public function getAll()
    {
//        return ElementResource::collection(Element::where('parent', '=', null)->get());
    }
}
