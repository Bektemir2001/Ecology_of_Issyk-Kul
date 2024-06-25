<?php

namespace App\Services;

use App\Models\District;
use App\Models\TrophicStateIndex;
use App\Models\TrophicStateIndexForElement;
use App\Repositories\TSIRepository;
use Exception;


class TrophicStateIndexService
{
    protected TSIRepository $TSIRepository;
    protected FormulaService $formulaService;

    public function __construct(TSIRepository $TSIRepository, FormulaService $formulaService)
    {
        $this->TSIRepository = $TSIRepository;
        $this->formulaService = $formulaService;
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
        try{
            $data = $this->TSIRepository->getTSI($year, $district);
            $pointElements = $data[1];
            $data = $data[0];
            $data->each(function ($value) use ($pointElements){
                $value->SD_TSI = $this->formulaService->formula7($value->transparency);
                $value->elements = $pointElements->where('point_id', '=', $value->point_id)->each(function ($item){
                    $item->tsi = call_user_func([$this->formulaService, $item->element->TSI_formula], $item->item);

                });
            });
            $grouped_data = $data->groupBy('control_point_id');
            $processedCollection = $grouped_data->map(function ($group) {
                $averageSD_TSI = $group->avg('SD_TSI');
                $firstItem = $group->first();

                $averageElements = [];
                foreach ($group as $item){
                    if(isset($item->elements))
                    {
                        foreach ($item->elements as $element)
                        {
                            if(array_key_exists($element->element_id, $averageElements))
                            {
                                $averageElements[$element->element_id]['tsi'] += $element->tsi;
                            }
                            else{
                                $averageElements[$element->element_id] = [
                                    'element_id' => $element->element_id,
                                    'name' => $element->element->name,
                                    'tsi' => $element->tsi
                                ];
                            }
                        }
                    }
                }
                $count_group = $group->count();
                $averageElementsRes = [];
                foreach ($averageElements as $element)
                {
                    $element['tsi'] /= $count_group;
                    $averageElementsRes[] = $element;
                }
                $firstItem->SD_TSI = $averageSD_TSI;
                $firstItem->averageElements = $averageElementsRes;
                return (array)$firstItem;
            });
            $elements = [];
            $control_points = $processedCollection->pluck('c_point_name');
            foreach ($processedCollection as $collection)
            {
                if(array_key_exists('sd_tsi', $elements))
                {
                    array_push($elements['sd_tsi'], $collection['SD_TSI']);
                }
                else{
                    $elements['sd_tsi'] = [$collection['SD_TSI']];
                }
                foreach ($collection['averageElements'] as $e)
                {
                    if(array_key_exists($e['name'], $elements))
                    {
                        array_push($elements[$e['name']], $e['tsi']);
                    }
                    else{
                        $elements[$e['name']] = [$e['tsi']];
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
            return [[], []];
        }

    }

	public function getTSIPoint(string $year): array
	{
		try{
			$data = $this->TSIRepository->getTSIPoint($year);
			$pointElements = $data[1];
			$data = $data[0];
			$data->each(function ($value) use ($pointElements){
				$value->SD_TSI = $this->formulaService->formula7($value->transparency);
				$value->elements = $pointElements->where('point_id', '=', $value->point_id)->each(function ($item){
					$item->tsi = call_user_func([$this->formulaService, $item->element->TSI_formula], $item->item);

				});
			});
			$grouped_data = $data->groupBy('control_point_id');
			$processedCollection = $grouped_data->map(function ($group) {
				$averageSD_TSI = $group->avg('SD_TSI');
				$firstItem = $group->first();

				$averageElements = [];
				foreach ($group as $item){
					if(isset($item->elements))
					{
						foreach ($item->elements as $element)
						{
							if(array_key_exists($element->element_id, $averageElements))
							{
								$averageElements[$element->element_id]['tsi'] += $element->tsi;
							}
							else{
								$averageElements[$element->element_id] = [
									'element_id' => $element->element_id,
									'name' => $element->element->name,
									'tsi' => $element->tsi
								];
							}
						}
					}
				}
				$count_group = $group->count();
				$averageElementsRes = [];
				foreach ($averageElements as $element)
				{
					$element['tsi'] /= $count_group;
					$averageElementsRes[] = $element;
				}
				$firstItem->SD_TSI = $averageSD_TSI;
				$firstItem->averageElements = $averageElementsRes;
				return (array)$firstItem;
			});
			$elements = [];
			$control_points = $processedCollection->pluck('control_point_id');
			foreach ($processedCollection as $collection)
			{
				if(array_key_exists('sd_tsi', $elements))
				{
					array_push($elements['sd_tsi'], $collection['SD_TSI']);
				}
				else{
					$elements['sd_tsi'] = [$collection['SD_TSI']];
				}
				foreach ($collection['averageElements'] as $e)
				{
					if(array_key_exists($e['name'], $elements))
					{
						array_push($elements[$e['name']], $e['tsi']);
					}
					else{
						$elements[$e['name']] = [$e['tsi']];
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
			return [[], []];
		}
	}
}
