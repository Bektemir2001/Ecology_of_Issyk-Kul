<?php

namespace App\Repositories;

use App\Models\District;
use App\Models\PointElement;
use Illuminate\Support\Facades\DB;

class TLIRepository
{
    public function getTLIData(string $year, int $district_id=null): array
    {
        $data = DB::table('districts')
            ->join('control_points as cp', 'cp.district_id', '=', 'districts.id')
            ->join('points as p', 'p.control_point_id', '=', 'cp.id');
        if($district_id !== null){
            $data = $data->where('districts.id', '=', $district_id);
        }
        $data = $data->whereYear('p.date', '=', $year)
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
                'p.date',
                'cp.id as control_point_id'
            )
            ->get();
        $pointElements = PointElement::whereIn('point_id', $data->pluck('point_id'))
            ->whereHas('element', function ($query){
                $query->where('TLI_formula', '!=', null);
            })
            ->get();
        return [$data, $pointElements];
    }

}
