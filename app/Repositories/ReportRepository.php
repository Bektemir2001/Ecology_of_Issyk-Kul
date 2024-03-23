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
                ->join('point_'.$data['table_field'].' as ' . $data['table_field'], 'points.id', '=', $data['table_field'].'point_id')
                ->select($data['table_field'].'.item', 'cp.name')
                ->whereYear('points.date', '=', $data['year'])
                ->where($data['table_field'].'.'.$data['related_field'], $data['children'])
                ->get();
            $result = $result->groupBy('name');
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

    private function getAverage($collection, string $field)
    {
        $collection = $collection->groupBy($field);
        return $collection->map(function ($group)
        {
            $average = $group->avg('item');
            $firstItem = $group->first();
            $firstItem->item = $average;
            return (array)$firstItem;
        });

    }
}
