<?php

namespace App\Repositories;

use App\Models\District;
use App\Models\PointElement;
use Illuminate\Support\Facades\DB;

class TSIRepository
{
    public function getTSI(string $year, District $district): array
    {
        $data = DB::table('districts')
            ->join('control_points as cp', 'cp.district_id', '=', 'districts.id')
            ->join('points as p', 'p.control_point_id', '=', 'cp.id')
            ->where('districts.id', '=', $district->id)
            ->whereYear('p.date', '=', $year)
            ->select(
                'cp.name as c_point_name',
                'p.distance_from_starting_point',
                'p.depth',
                'p.depth_item',
                'p.temperature',
                'p.transparency',
                'p.hardness',
                'p.electrical_conductivity',
                'p.pH',
                'p.oxygen_mg',
                'p.oxygen_saturation',
                'p.id as point_id',
                'p.date'
            )
            ->get();
        $pointElements = PointElement::whereIn('point_id', $data->pluck('point_id'))
            ->whereHas('element', function ($query){
                $query->where('TSI_formula', '!=', null);
            })
            ->get();
        return [$data, $pointElements];
    }

}
