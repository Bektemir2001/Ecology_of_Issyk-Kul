<?php

namespace App\Repositories;

use App\Models\Field;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function fields()
    {
        $fields = Field::select('field', 'model', 'table_field', 'related_field', 'pdk_up', 'pdk_dawn')->get();
        $fields->each(function ($value){
            if($value->model)
            {
                $model = app()->getNamespace() . 'Models\\' . $value->model;
                $value->children = $model::select('id', 'name', 'pdk_up', 'pdk_dawn')->get()->toArray();
            }
        });
        return $fields->toArray();
    }

    public function data(array $data): array
    {
        if(array_key_exists('children', $data))
        {
            $result = DB::table('points')
                ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
                ->join('point_'.$data['table_field'].' as r', 'points.id', '=', 'r.point_id')
                ->select('r.item', 'cp.name')
                ->whereYear('points.date', '=', $data['year'])
                ->where('r.'.$data['related_field'], $data['children'])
                ->get();
            $result = $this->getAverage($result, 'name');
            return ['items' => $result->pluck('item'), 'control_points' => $result->pluck('name')];
        }
        $result = DB::table('points')
            ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
            ->select($data['table_field'], 'cp.name')
            ->whereYear('points.date', '=', $data['year'])
            ->get();
        $result = $this->getAverage($result, 'name');
        return ['items' => $result->pluck($data['table_field']), 'control_points' => $result->pluck('name')];
    }


    public function dataForPoint(array $data): array
    {
        if(array_key_exists('children', $data))
        {
            $result = DB::table('points')
                ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
                ->join('point_'.$data['table_field'].' as r', 'points.id', '=', 'r.point_id')
                ->select('r.item', DB::raw('YEAR(points.date) as year'))
                ->where('cp.id', '=', $data['control_point_id'])
                ->where('r.'.$data['related_field'], $data['children'])
                ->get();
            $result = $this->getAverage($result, 'year');
            return ['items' => $result->pluck('item'), 'years' => $result->pluck('year')];
        }
        $result = DB::table('points')
            ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
            ->select($data['table_field'], DB::raw('YEAR(points.date) as year'))
            ->where('cp.id', '=', $data['control_point_id'])
            ->get();
        $result = $this->getAverage($result, 'year')->sortBy('year');
        return ['items' => $result->pluck($data['table_field']), 'years' => $result->pluck('year')];
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
