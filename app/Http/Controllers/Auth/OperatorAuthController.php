<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Staff\LoginRequest;
use App\Models\ControlPoint;
use App\Models\Lake;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OperatorAuthController extends Controller
{
    public function loginIndex() : View
    {
        return view('auth.operator.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            $user = auth()->user();
            if ($user->role === User::ROLE_OPERATOR)
            {
                $request->session()->regenerate();
                return redirect()->route('operator.index');
            }
            Auth::logout();
            return back()->withErrors([
                'email' => 'Not permission',
            ])->onlyInput('email');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
