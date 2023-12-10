<?php

namespace App\Services;

use App\Models\Element;
use Exception;

class ElementService
{
    protected UploadFileService $uploadFileService;
    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    public function store(array $data): array
    {
        try {
            if(array_key_exists('image', $data))
            {
                $data['image'] = $this->uploadFileService->upload($data['image'], 'images/elements');
            }

            Element::create($data);
            return ['message' => 'success', 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
