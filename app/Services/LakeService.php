<?php

namespace App\Services;

use App\Models\Lake;
use Exception;

class LakeService
{
    public function store(array $data): array
    {
        try{
            Lake::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

}
