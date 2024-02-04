<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function test()
    {
        return response(['message' => 'femg', 'user' => auth()->user()]);
    }
}
