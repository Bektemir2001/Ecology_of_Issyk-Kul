<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\ControlPoint;
use App\Models\Lake;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = User::all();
        $create_route = "admin.users.create";
        $title = "Users";
        $key = 'users';
        return view('admin.user.index', compact('data', 'create_route', 'title', 'key'));
    }
    public function show(User $user)
    {
        return view('admin.user.show', ['item' => $user]);
    }

    public function create()
    {
        return view('admin.user.create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->userService->store($data);
        return redirect()->route('admin.users.index')->with(['notification' => $result['message']]);
    }

    public function edit(User $user)
    {
        $lakes = Lake::all();
        $control_points = ControlPoint::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return view('admin.user.edit', ['item' => $user, 'lakes' => $lakes, 'control_points' => $control_points]);
    }

    public function update()
    {

    }
    public function delete()
    {

    }

    public function addControlPoint(User $user, Request $request)
    {
        $controlPointId = $request->validate(
            [
                'control_point' => 'required|numeric'
            ]
        );
        $result = $this->userService->addControlPoint($user, intval($controlPointId['control_point']));
        return back()->with(['notification' => $result['message']]);
    }
}
