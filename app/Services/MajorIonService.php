<?php

namespace App\Services;

use App\Models\MajorIon;
use Exception;

class MajorIonService extends Service
{
    public function store(array $data) : array
    {
        try{
            MajorIon::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update(array $data, MajorIon $majorIon): array
    {
        try{
            $majorIon->update($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

}
