<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ElementType\StoreRequest;
use App\Http\Requests\Admin\ElementType\UpdateRequest;
use App\Models\ElementType;
use App\Services\ElementTypeService;
use Illuminate\Http\Request;

class ElementTypeController extends Controller
{
    protected ElementTypeService $elementTypeService;

    public function __construct(ElementTypeService $elementTypeService)
    {
        $this->elementTypeService = $elementTypeService;
    }

    public function index()
    {
        $data = ElementType::all();
        $create_route = "admin.element_types.create";
        $title = 'Type of Elements';
        $key = 'element_types';
        return view('admin.element_type.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function create()
    {
        return view('admin.element_type.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->elementTypeService->store($data);
        return redirect()->route('admin.element_type.index')->with(['notification' => $result['message']]);
    }

    public function edit(ElementType $elementType)
    {
        return view('admin.element_type.edit', compact(['item' => $elementType]));
    }
    public function update(UpdateRequest $request, ElementType $elementType)
    {
        $data = $request->validated();
        $result = $this->elementTypeService->update($data, $elementType);
        return redirect()->route('admin.element_types.index')->with(['notification' => $result['message']]);
    }

    public function show(ElementType $elementType)
    {
        return view('admin.element_types.show', compact(['item' => $elementType]));
    }
    public function delete()
    {

    }
}
