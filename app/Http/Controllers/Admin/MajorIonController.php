<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MajorIon\StoreRequest;
use App\Http\Requests\Admin\MajorIon\UpdateRequest;
use App\Models\MajorIon;
use App\Services\MajorIonService;
use Illuminate\Http\Request;

class MajorIonController extends Controller
{
    protected MajorIonService $majorIonService;

    public function __construct(MajorIonService $majorIonService)
    {
        $this->majorIonService = $majorIonService;
    }

    public function index()
    {
        $data = MajorIon::all();
        $create_route = "admin.major_ions.create";
        $title = 'Major Ions';
        $key = 'major_ions';
        return view('admin.major_ion.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function create()
    {
        return view('admin.major_ion.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->majorIonService->store($data);
        return redirect()->route('admin.major_ions.index')->with(['notification' => $result['message']]);
    }

    public function edit(MajorIon $majorIon)
    {
        return view('admin.major_ion.edit', compact(['item' => $majorIon]));
    }
    public function update(UpdateRequest $request, MajorIon $majorIon)
    {
        $data = $request->validated();
        $result = $this->majorIonService->update($data, $majorIon);
        return redirect()->route('admin.major_ions.index')->with(['notification' => $result['message']]);
    }

    public function show(MajorIon $majorIon)
    {
        return view('admin.major_ions.show', compact(['item' => $majorIon]));
    }
    public function delete()
    {

    }
}
