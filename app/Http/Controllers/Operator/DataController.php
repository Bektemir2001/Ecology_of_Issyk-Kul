<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\StorePointRequest;
use App\Models\Element;
use App\Models\Lake;
use App\Models\MajorIon;
use App\Models\OrganicSubstance;
use App\Models\Point;
use App\Services\Operator\PointService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DataController extends Controller
{
    protected PointService $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function index(): View
    {
        $points = Point::all();
        return view('operator.data.index', compact('points'));
    }

    public function create(): View
    {
        $lakes = Lake::all();
        return view('operator.data.create', compact('lakes'));
    }

    public function store(StorePointRequest $request): Response
    {
        $data = $request->validated();
        $result = $this->pointService->store($data, auth()->id());
        return response(['message' => $result['message']])->setStatusCode($result['status']);
    }

    public function edit(Point $point): View
    {
        $lakes = Lake::all();
        $elements = Element::all();
        $elements = $elements->filter(function ($item){
            return count($item->children) === 0;
        });
        $ions = MajorIon::all();
        $organic_substances = OrganicSubstance::all();

        $pointElements = $point->pointElements->pluck('item', 'element_id')->toArray();
        $pointIons = $point->pointIons->pluck('item', 'ion_id')->toArray();
        $pointOrganics = $point->pointOrganics->pluck('item', '_id')->toArray();
        return view('operator.data.edit', compact('point', 'lakes',
            'elements', 'ions', 'organic_substances',
            'pointElements', 'pointIons', 'pointOrganics'));
    }

    public function update(Request $request, Point $point)
    {
        dd($request->all());
    }
}
