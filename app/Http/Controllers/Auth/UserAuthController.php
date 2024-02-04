<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\LoginRequest;
use App\Http\Requests\Auth\User\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $user->tokens()->delete();
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            User::create($data);
            return response(['message' => 'success']);
        }
        catch (\Exception $e)
        {
            return response(['message' => $e->getMessage()])->setStatusCode($e->getCode());
        }
    }
}
