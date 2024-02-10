<?php

namespace App\Services;

use App\Models\District;
use Exception;

class DistrictService extends Service
{
    public function store(array $data): array
    {
        try {
            if(array_key_exists('images', $data))
            {
                $images = [];
                foreach ($data['images'] as $image)
                {
                    $images[] = $this->uploadFileService->upload($image, 'images/districts');
                }
                $data['images'] = $images;
            }

            District::create($data);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
