<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\District\StoreRequest;
use App\Models\District;
use App\Services\DistrictService;
use Illuminate\Http\Request;

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
        return view('admin.district.create');
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
}
