<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Lake\StoreRequest;
use App\Models\Lake;
use Illuminate\Http\Request;

class LakeController extends Controller
{
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

    }
}
