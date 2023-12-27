<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function postData(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'number' => '',
            'video' => ''
        ]);
        dd($data);
        return response(['data' => 'success']);
    }
}
