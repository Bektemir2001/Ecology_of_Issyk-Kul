<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Http\Resources\ControlPointResource;
use App\Models\ControlPoint;
use App\Models\Field;
use Carbon\Carbon;


class ControlPointController extends Controller
{
    public function getAll()
    {
        return ControlPointResource::collection(ControlPoint::all());
    }

    public function getWithPDK(ReportRequest $request)
    {
        $data = $request->validated();
        if(array_key_exists('children', $data)) {
            dd("bektemir");
        }

        $result = ControlPoint::all();
        $year = $data['year'];
        $table_field = $data["table_field"];
        $pdk = Field::query()->where('table_field', $table_field)->first();
        $result->each(function ($item) use ($year, $table_field, $pdk) {
            $points = $item->points;
            $points = $points->filter(function ($point) use ($year) {
                $date = Carbon::createFromFormat('Y-m-d', $point->date);
                return $year == strval($date->year);
            });
            $item = $points->avg($table_field);
            $item->color = $this->getColor($item, $pdk->pdk_up);
        });
        dd($result);
    }

    public function getColor($item, $pdk)
    {
        $colors = ['#000', '#32CD32', '#FFFF00', '#FF0000'];
        if($item == null || $pdk == null || $item == 0)
        {
            return $colors[0];
        }
        $avg = (($item - $pdk)/$pdk) * 100;
        if($avg <= 10 and $avg >= -10)
        {
            return $colors[1];
        }
        elseif($avg > 10)
        {
            return $colors[3];
        }
        else
        {
            return $colors[2];
        }
    }


    private function getAverage($collection, string $field)
    {
        $collection = $collection->groupBy($field);
        return $collection->map(function ($group)
        {
            $average = round($group->avg('item'), 2);
            $firstItem = $group->first();
            $firstItem->item = $average;
            return (array)$firstItem;
        });

    }
}
