<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\District\StoreRequest;
use App\Http\Resources\GeneralResource;
use App\Models\District;
use App\Models\Lake;
use App\Services\DistrictService;

class DistrictController extends Controller
{
    protected DistrictService $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function index()
    {
        $data = District::all();
        $create_route = "admin.districts.create";
        $title = "Districts";
        $key = 'districts';
        return view('admin.district.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function show(District $district)
    {
        return view('admin.district.show', compact(['item' => $district]));
    }

    public function create()
    {
        $lakes = Lake::all();
        return view('admin.district.create', compact('lakes'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->districtService->store($data);
        return redirect()->route('admin.districts.index')->with(['notification' => $result['message']]);
    }

    public function edit(District $district)
    {
        return view('admin.district.edit', compact(['item' => $district]));
    }

    public function update()
    {

    }
    public function delete()
    {

    }

    public function getAll(Lake $lake)
    {
        return GeneralResource::collection($lake->districts);
    }
}
