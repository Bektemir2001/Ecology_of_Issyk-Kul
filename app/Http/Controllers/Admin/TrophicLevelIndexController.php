<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrophicLevelIndex\StoreRequest;
use App\Http\Requests\Admin\TrophicLevelIndex\UpdateRequest;
use App\Http\Resources\GeneralResource;
use App\Models\TrophicLevelIndex;
use App\Services\TrophicLevelIndexService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class TrophicLevelIndexController extends Controller
{
    protected TrophicLevelIndexService $trophicLevelIndexService;

    public function __construct(TrophicLevelIndexService $trophicLevelIndexService)
    {
        $this->trophicLevelIndexService = $trophicLevelIndexService;
    }

    public function index(): View
    {
        $data = TrophicLevelIndex::all();
        $create_route = "admin.trophic.level.index.create";
        $title = 'Trophic Level Index';
        $key = 'trophic.level.index';
        return view('admin.trophic_level_index.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function create(): View
    {
        return view('admin.trophic_level_index.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->trophicLevelIndexService->store($data);
        return redirect()->route('admin.trophic.level.index.index')->with(['notification' => $result['message']]);
    }

    public function edit(TrophicLevelIndex $majorIon): View
    {
        return view('admin.trophic_level_index.edit', compact(['item' => $majorIon]));
    }
    public function update(UpdateRequest $request, TrophicLevelIndex $trophicLevelIndex): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->trophicLevelIndexService->update($data, $trophicLevelIndex);
        return redirect()->route('admin.trophic.level.index.index')->with(['notification' => $result['message']]);
    }

    public function show(TrophicLevelIndex $trophicLevelIndex): View
    {
        return view('admin.trophic_level_index.show', compact(['item' => $trophicLevelIndex]));
    }
    public function delete()
    {

    }

    public function getAll(): JsonResource
    {
        return GeneralResource::collection(TrophicLevelIndex::all());
    }
}
