<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Element\StoreRequest;
use App\Models\Element;
use App\Services\ElementService;

class ElementController extends Controller
{
    protected ElementService $elementService;

    public function __construct(ElementService $elementService)
    {
        $this->elementService = $elementService;
    }

    public function index()
    {
        $data = Element::all();
        return view('admin.element.index', compact('data'));
    }

    public function show(Element $element)
    {
        return view('admin.element.show', compact(['item' => $element]));
    }

    public function create()
    {
        return view('admin.element.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->elementService->store($data);
        return redirect()->route('admin.elements.index')->with(['notification' => $result['message']]);
    }

    public function edit(Element $element)
    {
        return view('admin.element.edit', compact(['item' => $element]));
    }

    public function update()
    {

    }
}
