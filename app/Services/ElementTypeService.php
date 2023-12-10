<?php

namespace App\Services;

use App\Models\ElementType;
use Exception;

class ElementTypeService
{
    protected UploadFileService $uploadFileService;
    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    public function store(array $data): array
    {
        try{
            if(array_key_exists('image', $data))
            {
                $data['image'] = $this->uploadFileService->upload($data['image'], 'images/elements');
            }
            ElementType::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update(): array
    {
        return [];
    }
}
