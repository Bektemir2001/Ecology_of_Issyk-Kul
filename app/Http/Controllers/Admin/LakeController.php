<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lake;
use Illuminate\Http\Request;

class LakeController extends Controller
{
    public function index()
    {
        $data = Lake::all();
        return view('admin.lake.index', compact('data'));
    }
}
