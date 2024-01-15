<?php

namespace App\Services;

class Service
{
    protected UploadFileService $uploadFileService;
    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }
}
