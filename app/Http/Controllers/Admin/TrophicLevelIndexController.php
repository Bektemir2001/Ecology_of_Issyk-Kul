<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrophicLevelIndex\ElementRequest;
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
        $title = 'Add Trophic Level Index';
        $create_url = 'admin.trophic.level.index.store';
        return view('admin.trophic_level_index.create', compact('create_url', 'title'));
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
        $add_element_url = 'admin.trophic.level.index.addElement';
        $t_index_id = 'tli_index_id';
        return view('admin.trophic_level_index.show', [
            'item' => $trophicLevelIndex,
            't_index_id' => $t_index_id,
            'add_element_url' => $add_element_url
        ]);
    }
    public function delete()
    {

    }

    public function addElement(ElementRequest $request)
    {
        $data = $request->validated();
        $result = $this->trophicLevelIndexService->addElementIndex($data);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

    public function getAll(): JsonResource
    {
        return GeneralResource::collection(TrophicLevelIndex::all());
    }
}
