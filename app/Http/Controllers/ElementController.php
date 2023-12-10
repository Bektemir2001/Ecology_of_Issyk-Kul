<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Element\StoreRequest;
use App\Models\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
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
    }
}
