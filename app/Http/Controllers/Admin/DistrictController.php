<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\District\StoreRequest;
use App\Http\Requests\Admin\District\UpdateRequest;
use App\Http\Resources\GeneralResource;
use App\Models\District;
use App\Models\Lake;
use App\Services\DistrictService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DistrictController extends Controller
{
    protected DistrictService $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function index(): View
    {
        $data = District::all();
        $create_route = "admin.districts.create";
        $title = "Districts";
        $key = 'districts';
        return view('admin.district.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function show(District $district): View
    {
        return view('admin.district.show', compact(['item' => $district]));
    }

    public function create(): View
    {
        $lakes = Lake::all();
        return view('admin.district.create', compact('lakes'));
    }
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->districtService->store($data);
        return redirect()->route('admin.districts.index')->with(['notification' => $result['message']]);
    }

    public function edit(District $district): View
    {
        $lakes = Lake::all();
        return view('admin.district.edit', ['item' => $district, 'lakes' => $lakes]);
    }

    public function update(UpdateRequest $request, District $district): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->districtService->update($data, $district);
        return redirect()->route('admin.districts.index')->with(['notification' => $result['message']]);

    }
    public function delete()
    {

    }

    public function getAll(Lake $lake)
    {
        return GeneralResource::collection($lake->districts);
    }
}
