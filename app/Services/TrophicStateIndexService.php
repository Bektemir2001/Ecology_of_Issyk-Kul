<?php

namespace App\Services;

use App\Models\District;
use App\Models\TrophicStateIndex;
use App\Models\TrophicStateIndexForElement;
use App\Repositories\TSIRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class TrophicStateIndexService
{
    protected TSIRepository $TSIRepository;

    public function __construct(TSIRepository $TSIRepository)
    {
        $this->TSIRepository = $TSIRepository;
    }

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

    public function getTSI(string $year, District $district): array
    {
        $data = $this->TSIRepository->getTSI($year, $district);
    }
}
