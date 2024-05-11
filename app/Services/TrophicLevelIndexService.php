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


    public function getDistrictTLI(string $year, int $district_id=null)
    {
        try{
            $data = $this->TLIRepository->getTLIData($year, $district_id);
            $pointElements = $data[1];
            $data = $data[0];
            $data->each(function ($value) use ($pointElements){
                $value->SD_TLI = $this->formulaService->formula2($value->transparency);
                dd($pointElements->where('point_id', '=', $value->point_id)->get());

                $value->elements = $pointElements->where('point_id', '=', $value->point_id)->each(function ($item){
                    $item->tli = call_user_func([$this->formulaService, $item->element->TLI_formula], $item->item);
                });
                dd($value->elements);
            });

            $grouped_data = $data->groupBy('control_point_id');
            $processedCollection = $grouped_data->map(function ($group) {
                $averageSD_TLI = $group->avg('SD_TLI');
                $firstItem = $group->first();

                $averageElements = [];
                foreach ($group as $item){
                    if(isset($item->elements))
                    {
                        foreach ($item->elements as $element)
                        {
                            if(array_key_exists($element->element_id, $averageElements))
                            {
                                $averageElements[$element->element_id]['tli'] += $element->tli;
                            }
                            else{
                                $averageElements[$element->element_id] = [
                                    'element_id' => $element->element_id,
                                    'name' => $element->element->name,
                                    'tli' => $element->tli
                                ];
                            }
                        }
                    }
                }
                $count_group = $group->count();
                $averageElementsRes = [];
                foreach ($averageElements as $element)
                {
                    $element['tli'] /= $count_group;
                    $averageElementsRes[] = $element;
                }
                $firstItem->SD_TLI = $averageSD_TLI;
                $firstItem->averageElements = $averageElementsRes;
                return (array)$firstItem;
            });
            $elements = [];
            $control_points = $processedCollection->pluck('c_point_name');
            foreach ($processedCollection as $collection)
            {
                if(array_key_exists('sd_tli', $elements))
                {
                    array_push($elements['sd_tli'], $collection['SD_TLI']);
                }
                else{
                    $elements['sd_tli'] = [$collection['SD_TLI']];
                }
                foreach ($collection['elements'] as $e)
                {
                    if(array_key_exists($e->element->name, $elements))
                    {
                        array_push($elements[$e->element->name], $e->tli);
                    }
                    else{
                        $elements[$e->element->name] = [$e->tli];
                    }
                }


            }
            if(count($elements) != 4)
            {
                return [[], []];
            }
            return [$elements, $control_points];
        }
        catch (Exception $e)
        {
            dd($e->getMessage());
            return [[], []];
        }

    }
}
