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
        $result = $this->data($request->validated());
        dd($result);
    }

    public function data(array $data): array
    {
        if(array_key_exists('children', $data))
        {
            $result = DB::table('control_points as cp')
                ->leftJoin('points', 'cp.id', '=', 'points.control_point_id')
                ->join('point_'.$data['table_field'].' as r', 'points.id', '=', 'r.point_id')
                ->select('r.item', 'cp.*')
                ->whereYear('points.date', '=', $data['year'])
                ->where('r.'.$data['related_field'], $data['children'])
                ->get();
            dd($result);
            $result = $this->getAverage($result, 'name');
            return ['items' => $result->pluck('item'), 'control_points' => $result];
        }
        $result = DB::table('points')
            ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
            ->select($data['table_field'], 'cp.name')
            ->whereYear('points.date', '=', $data['year'])
            ->get();
        $result = $this->getAverage($result, 'name');
        return ['items' => $result->pluck($data['table_field']), 'control_points' => $result->pluck('name')];
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
