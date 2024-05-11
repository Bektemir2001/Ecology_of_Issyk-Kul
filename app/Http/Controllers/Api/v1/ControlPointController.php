<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Http\Resources\ControlPointResource;
use App\Models\ControlPoint;
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
        $result->each(function ($item) use ($year, $table_field) {
            $points = $item->points;
            $points = $points->filter(function ($point) use ($year) {
                $date = Carbon::createFromFormat('Y-m-d', $point->date);
                return $year == strval($date->year);
            });
            $item = $points->avg($table_field);
            dd($item);
            $item->points = $points;
        });
        dd($result);
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
