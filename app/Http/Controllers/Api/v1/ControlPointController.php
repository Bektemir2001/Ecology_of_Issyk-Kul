<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Http\Resources\ControlPointResource;
use App\Http\Resources\GeneralResource;
use App\Models\ControlPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $result->each(function ($item) use ($data) {
//            dd($item->points->whereYear('date', $data['year']));
            dd($item->points);
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
