<?php

namespace App\Services;

use App\Models\TrophicStateIndex;
use App\Models\TrophicStateIndexForElement;
use Exception;

class TrophicStateIndexService
{
    public function store(array $data): array
    {
        try{
            TrophicStateIndex::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update(array $data, TrophicStateIndex $trophicLevelIndex): array
    {
        try{
            $trophicLevelIndex->update($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function addElementIndex(array $data): array
    {
        try{
            TrophicStateIndexForElement::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
