<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Element\StoreRequest;
use App\Http\Requests\Admin\Element\UpdateRequest;
use App\Http\Resources\ElementResource;
use App\Models\Element;
use App\Services\ElementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $elements = Element::where('parent', '=', null)->get();
        return view('admin.element.create', compact('elements'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->elementService->store($data);
        return redirect()->route('admin.elements.index')->with(['notification' => $result['message']]);
    }

    public function edit(Element $element)
    {
        $elements = Element::where('parent', '=', null)->get();
        return view('admin.element.edit', ['item' => $element, 'elements' => $elements]);
    }

    public function update(UpdateRequest $request, Element $element)
    {
        $data = $request->validated();
        $result = $this->elementService->update($element, $data);
        dd($data);
    }
    public function delete()
    {

    }

    public function getAll(Request $request)
    {
        $t_index = $request->validate(['t_index_id' => 'nullable']);
        if(isset($t_index['t_index_id']))
        {
            $elements = Element::whereDoesntHave('trophicLevelIndex', function ($query) use ($t_index) {
                $query->where('t_index_id', $t_index['t_index_id']);
            })
                ->where('parent', '=', null)
                ->get();
            return ElementResource::collection($elements);
        }
        return ElementResource::collection(Element::where('parent', '=', null)->get());
    }
}
