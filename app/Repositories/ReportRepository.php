<?php

namespace App\Repositories;

use App\Models\Field;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function fields()
    {
        $fields = Field::select('field', 'model', 'table_field')->get();
        $fields->each(function ($value){
            if($value->model)
            {
                $model = app()->getNamespace() . 'Models\\' . $value->model;
                $value->children = $model::select('id', 'name')->get()->toArray();
            }
        });
        return $fields->toArray();
    }

    public function data(array $data): array
    {
        if(array_key_exists('children', $data))
        {
            $data = DB::table('points')
                ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
                ->join('point_'.$data['table_field'].' as ' . $data['table_field'], 'points.id', '=', $data['table_field'].'point_id')
                ->select($data['table_field'].'item', 'cp.name')
                ->whereYear('points.date', '=', $data['year'])
                ->where($data['table_field'].'.'.$data['related_field'], $data['children'])
                ->get();
            return ['items' => $data->pluck('item'), 'control_points' => $data->pluck('name')];
        }
        $data = DB::table('points')
            ->join('control_points as cp', 'cp.id', '=', 'points.control_point_id')
            ->select($data['table_field'], 'cp.name')
            ->whereYear('points.date', '=', $data['year'])
            ->get();
        return ['items' => $data->pluck($data['table_field']), 'control_points' => $data->pluck('name')];
    }
}
