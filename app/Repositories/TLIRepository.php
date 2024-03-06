<?php

namespace App\Repositories;

use App\Models\District;
use Illuminate\Support\Facades\DB;

class TLIRepository
{
    public function getTLI(string $year, District $district)
    {
        $data = DB::table('districts')
            ->join('control_points as cp', 'cp.district_id', '=', 'districts.id')
            ->join('points as p', 'p.control_point_id', '=', 'cp.id')
            ->join('');
    }

}
