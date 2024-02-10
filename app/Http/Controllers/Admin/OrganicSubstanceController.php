<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganicSubstance\StoreRequest;
use App\Http\Resources\GeneralResource;
use App\Models\OrganicSubstance;
use App\Services\OrganicSubstanceService;

class OrganicSubstanceController extends Controller
{
    protected OrganicSubstanceService $organicSubstanceService;

    public function __construct(OrganicSubstanceService $organicSubstanceService)
    {
        $this->organicSubstanceService = $organicSubstanceService;
    }

    public function index()
    {
        $data = OrganicSubstance::all();
        $create_route = "admin.organic_substances.create";
        $title = "Organic Substances";
        $key = 'organic_substances';
        return view('admin.organic_substance.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function show(OrganicSubstance $organicSubstance)
    {
        return view('admin.organic_substance.show', compact(['item' => $organicSubstance]));
    }

    public function create()
    {
        return view('admin.organic_substance.create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->organicSubstanceService->store($data);
        return redirect()->route('admin.organic_substances.index')->with(['notification' => $result['message']]);
    }

    public function edit(Element $element)
    {
        return view('admin.element.edit', compact(['item' => $element]));
    }

    public function update()
    {

    }
    public function delete()
    {

    }

    public function getAll()
    {
        return GeneralResource::collection(OrganicSubstance::all());
    }
}
