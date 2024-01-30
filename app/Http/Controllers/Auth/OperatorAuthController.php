<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Staff\LoginRequest;
use App\Models\ControlPoint;
use App\Models\Lake;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OperatorAuthController extends Controller
{
    public function loginIndex() : View
    {
        $lakes = Lake::all();
        $control_points = null;
        if($lakes)
        {
            $control_points = ControlPoint::where('lake_id', $lakes[0]->id)->get();
        }
        return view('auth.operator.login', compact('lakes', 'control_points'));
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            $user = auth()->user();
            $user_control_points = $user->controlPoints;
            if ($user_control_points->contains('id', $data['control_point']))
            {
                $request->session()->regenerate();
                session(['control_point' => $data['control_point']]);
                return redirect()->route('operator.index');
            }
            Auth::logout();
            return back()->withErrors([
                'control_point' => 'Not permission for this control point',
            ])->onlyInput('control_point');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
