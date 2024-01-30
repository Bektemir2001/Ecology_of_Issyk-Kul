<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\ControlPoint;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return view('operator.data.index');
    }

    public function create()
    {

        $control_point = ControlPoint::where('id', session('control_point'))->first();
        return view('operator.data.create', compact('control_point'));
    }
}
