<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrophicStateIndex\ElementRequest;
use App\Http\Requests\Admin\TrophicStateIndex\StoreRequest;
use App\Http\Requests\Admin\TrophicStateIndex\UpdateRequest;
use App\Http\Resources\GeneralResource;
use App\Models\TrophicStateIndex;
use App\Services\TrophicStateIndexService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class TrophicStateIndexController extends Controller
{
    protected TrophicStateIndexService $trophicStateIndexService;

    public function __construct(TrophicStateIndexService $trophicStateIndexService)
    {
        $this->trophicStateIndexService = $trophicStateIndexService;
    }

    public function index(): View
    {
        $data = TrophicStateIndex::all();
        $create_route = "admin.trophic.state.index.create";
        $title = 'Trophic State Index';
        $key = 'trophic.state.index';
        return view('admin.trophic_state_index.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function create(): View
    {
        return view('admin.trophic_state_index.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->trophicStateIndexService->store($data);
        return redirect()->route('admin.trophic.state.index.index')->with(['notification' => $result['message']]);
    }

    public function edit(TrophicStateIndex $majorIon): View
    {
        return view('admin.trophic_state_index.edit', compact(['item' => $majorIon]));
    }
    public function update(UpdateRequest $request, TrophicStateIndex $trophicStateIndex): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->trophicStateIndexService->update($data, $trophicStateIndex);
        return redirect()->route('admin.trophic.state.index.index')->with(['notification' => $result['message']]);
    }

    public function show(TrophicStateIndex $trophicStateIndex): View
    {
        return view('admin.trophic_state_index.show', ['item' => $trophicStateIndex]);
    }
    public function delete()
    {

    }

    public function addElement(ElementRequest $request)
    {
        $data = $request->validated();
        $result = $this->trophicStateIndexService->addElementIndex($data);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

    public function getAll(): JsonResource
    {
        return GeneralResource::collection(TrophicStateIndex::all());
    }
}
