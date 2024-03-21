<?php

namespace App\Services;

use App\Repositories\BufferZoneRepository;
use Exception;

class BufferZoneServices
{
    protected BufferZoneRepository $bufferZoneRepository;

    public function __construct(BufferZoneRepository $bufferZoneRepository)
    {
        $this->bufferZoneRepository = $bufferZoneRepository;
    }

    public function horizontalCalculate(array $tli, string $year, int $district, float $cost): array
    {
        try{
            $average_tli = 0;
            foreach ($tli[0] as $element)
            {
                $average_tli += array_sum($element)/count($element);
            }
            if(count($tli[0]) == 0)
            {
                return ['result' => [], 'code' => 404];
            }
            $average_tli /= count($tli[0]);
            $data = $this->bufferZoneRepository->horizontalBufferZone($year, $district);
            $distances = [];
            $items = [];
            $data->each(function ($value) use ($average_tli, $cost, $distances, $items){
                $value->item = sprintf("%.3E", (3 * $average_tli)/($value->area * $cost));
                array_push($items, $value->item);
                array_push($distances, $value->from_the_coast);
            });
            return ['result' => ['distances' => $distances, 'items' => $items], 'code' => 200];
        }
        catch (Exception $exception)
        {
            return ['message' => $exception->getMessage(), 'code' => 500];
        }

    }
}
