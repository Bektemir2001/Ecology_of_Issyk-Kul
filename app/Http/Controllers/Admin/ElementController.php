<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Element\StoreRequest;
use App\Http\Requests\Admin\Element\UpdateRequest;
use App\Models\Element;
use App\Models\Formula;
use App\Services\ElementService;
use Illuminate\Http\Request;


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
        $create_route = "admin.elements.create";
        $title = "Elements";
        $key = 'elements';
        return view('admin.element.index', compact('data', 'create_route', 'title', 'key'));
    }

    public function show(Element $element)
    {
        return view('admin.element.show', compact(['item' => $element]));
    }

    public function create()
    {
        $formulas = Formula::all();
        $elements = Element::where('parent', '=', null)->get();
        return view('admin.element.create', compact('elements', 'formulas'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->elementService->store($data);
        return redirect()->route('admin.elements.index')->with(['notification' => $result['message']]);
    }

    public function edit(Element $element)
    {
        $formulas = Formula::all();
        $elements = Element::where('parent', '=', null)->get();
        return view('admin.element.edit', ['item' => $element, 'elements' => $elements, 'formulas' => $formulas]);
    }

    public function update(UpdateRequest $request, Element $element)
    {
        $data = $request->validated();
        $result = $this->elementService->update($element, $data);
        return redirect()->route('admin.elements.index')->with(['notification' => $result['message']]);
    }
    public function delete()
    {

    }

    public function getAll(Request $request)
    {
        $t_index = $request->validate(['tli_index_id' => 'nullable', 'tsi_index_id' => 'nullable']);
        return $this->elementService->getAll($t_index);
    }
}
