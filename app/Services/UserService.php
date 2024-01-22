<?php

namespace App\Services;

use App\Models\ControlPoint;
use App\Models\User;
use App\Models\UserControlPoint;
use Exception;

class UserService extends Service
{
    public function store(array $data): array
    {
        try {
            if(array_key_exists('image', $data))
            {
                $data['image'] = $this->uploadFileService->upload($data['image'], 'images/users');
            }
            User::create($data);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update()
    {

    }

    public function addControlPoint(User $user, int $controlPointId): array
    {
        try{
            UserControlPoint::create([
                'user_id' => $user->id,
                'control_point_id' => $controlPointId
            ]);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }

    }
}
