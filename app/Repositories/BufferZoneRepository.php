<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BufferZoneRepository
{
    public function horizontalBufferZone(string $year, int $district_id)
    {
        return DB::table('earth_transformation_indicators')
            ->where('district_id', $district_id)
            ->whereYear('date', '=', $year)
            ->orderBy('from_the_coast')
            ->get();
    }
}
