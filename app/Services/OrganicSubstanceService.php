<?php

namespace App\Services;

use App\Models\OrganicSubstance;
use Exception;

class OrganicSubstanceService extends Service
{
    public function store(array $data): array
    {
        try {
            if(array_key_exists('image', $data))
            {
                $data['image'] = $this->uploadFileService->upload($data['image'], 'images/elements');
            }

            OrganicSubstance::create($data);
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
}
