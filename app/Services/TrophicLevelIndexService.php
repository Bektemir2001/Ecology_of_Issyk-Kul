<?php

namespace App\Services;

use App\Models\District;
use App\Models\IntervalTrophicLevelIndexForElement;
use App\Models\TrophicLevelIndex;
use App\Repositories\TLIRepository;
use Exception;

class TrophicLevelIndexService
{
    protected TLIRepository $TLIRepository;

    public function __construct(TLIRepository $TLIRepository)
    {
        $this->TLIRepository = $TLIRepository;
    }

    public function store(array $data): array
    {
        try{
            TrophicLevelIndex::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update(array $data, TrophicLevelIndex $trophicLevelIndex): array
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
            IntervalTrophicLevelIndexForElement::create($data);
            return ['message' => __('success'), 'code' => 200];
        }
        catch (Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }


    public function getDistrictTLI(string $year, District $district)
    {
        $data = $this->TLIRepository->getTLI($year, $district);
    }
}
