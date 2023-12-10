<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Lake\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Lake;
use App\Services\LakeService;
use Illuminate\Http\Request;

class LakeController extends Controller
{
    protected LakeService $lakeService;

    public function __construct(LakeService $lakeService)
    {
        $this->lakeService = $lakeService;
    }

    public function index()
    {
        $data = Lake::all();
        return view('admin.lake.index', compact('data'));
    }

    public function create()
    {
        return view('admin.lake.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->lakeService->store($data);
        return redirect()->route('admin.lakes.index')->with(['notification' => $result['message']]);
    }

    public function edit(Lake $lake)
    {
        return view('admin.lake.edit', compact('lake'));
    }
    public function update(UpdateRequest $request, Lake $lake)
    {
        $data = $request->validated();
        $result = $this->lakeService->update($data, $lake);
        return redirect()->route('admin.lakes.index')->with(['notification' => $result['message']]);
    }

    public function show(Lake $lake)
    {
        return view('admin.lake.show', compact('lake'));
    }
}
