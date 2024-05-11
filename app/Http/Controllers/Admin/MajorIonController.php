<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MajorIon\StoreRequest;
use App\Http\Requests\Admin\MajorIon\UpdateRequest;
use App\Http\Resources\GeneralResource;
use App\Models\MajorIon;
use App\Services\MajorIonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class MajorIonController extends Controller
{
    protected MajorIonService $majorIonService;

    public function __construct(MajorIonService $majorIonService)
    {
        $this->majorIonService = $majorIonService;
    }

    public function index(): View
    {
        $data = MajorIon::all();
        $create_route = "admin.major_ions.create";
        $title = 'Major Ions';
        $key = 'major_ions';
        return view('admin.major_ion.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function create(): View
    {
        return view('admin.major_ion.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->majorIonService->store($data);
        return redirect()->route('admin.major_ions.index')->with(['notification' => $result['message']]);
    }

    public function edit(MajorIon $majorIon): View
    {
        return view('admin.major_ion.edit', ['item' => $majorIon]);
    }
    public function update(UpdateRequest $request, MajorIon $majorIon): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->majorIonService->update($data, $majorIon);
        return redirect()->route('admin.major_ions.index')->with(['notification' => $result['message']]);
    }

    public function show(MajorIon $majorIon): View
    {
        return view('admin.major_ions.show', compact(['item' => $majorIon]));
    }
    public function delete()
    {

    }

    public function getAll(): JsonResource
    {
        return GeneralResource::collection(MajorIon::all());
    }
}
