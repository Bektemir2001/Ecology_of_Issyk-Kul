<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EarthTransformationIndicator\StoreRequest;
use App\Http\Requests\Admin\EarthTransformationIndicator\UpdateRequest;
use App\Models\District;
use App\Models\EarthTransformationIndicator;
use App\Services\EarthTransformationIndicatorService;
use Carbon\Carbon;
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
        $create_route = "operator.earth.transformation.indicators.create";
        $title = "Earth Transformation Indicators";
        $key = 'earth.transformation.indicators';
        return view('operator.earth_transformation_indicator.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function show(EarthTransformationIndicator $earthTransformationIndicator)
    {
        return view('operator.earth_transformation_indicator.show', compact(['item' => $earthTransformationIndicator]));
    }

    public function create()
    {
        $districts = District::all();
        return view('operator.earth_transformation_indicator.create', compact('districts'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->earthTransformationIndicatorService->store($data);
        if($result['code'] != 200)
        {
            return back()->withErrors(['unique' => $result['message']]);
        }
        return redirect()->route('operator.earth.transformation.indicators.index')->with(['notification' => $result['message']]);
    }

    public function edit(EarthTransformationIndicator $earthTransformationIndicator)
    {
        $districts = District::all();
        return view('operator.earth_transformation_indicator.edit', ['item' => $earthTransformationIndicator, 'districts' => $districts]);
    }

    public function update(UpdateRequest $request, EarthTransformationIndicator $earthTransformationIndicator)
    {
        $data = $request->validated();
        $result = $this->earthTransformationIndicatorService->update($data, $earthTransformationIndicator);
        return redirect()->route('operator.earth.transformation.indicators.index')->with(['notification' => $result['message']]);
    }
    public function delete()
    {

    }

    public function getAll()
    {
//        return ElementResource::collection(Element::where('parent', '=', null)->get());
    }
}
