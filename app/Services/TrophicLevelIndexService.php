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
    protected FormulaService $formulaService;
    public function __construct(TLIRepository $TLIRepository, FormulaService $formulaService)
    {
        $this->TLIRepository = $TLIRepository;
        $this->formulaService = $formulaService;
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
        $data = $this->TLIRepository->getTLIData($year, $district);
        $pointElements = $data[1];
        $data = $data[0];
        $data->each(function ($value) use ($pointElements){
            $value->SD_TLI = $this->formulaService->formula2($value->transparency);
            $value->elements = $pointElements->where('point_id', '=', $value->point_id)->each(function ($item){
                $item->tli = call_user_func([$this->formulaService, $item->element->TLI_formula], $item->item);
            })->toArray();
        });
        dd($data);
    }
}
