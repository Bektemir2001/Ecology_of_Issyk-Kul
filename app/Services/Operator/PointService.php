<?php

namespace App\Services\Operator;

use App\Models\Point;
use App\Models\PointElement;
use App\Models\PointMajorIon;
use App\Models\PointOrganicSubstance;
use Exception;
use Illuminate\Support\Facades\DB;

class PointService
{
    public function store(array $data, int $user_id): array
    {
        try {
            DB::beginTransaction();
            $elements = json_decode($data['elements'], true);
            $major_ions = json_decode($data['major_ions'], true);
            $organic_substances = json_decode($data['organic_substances'], true);
            unset($data['elements']);
            unset($data['major_ions']);
            unset($data['organic_substances']);
            $data['user_id'] = $user_id;
            $point = Point::create($data);
            $this->saveElements($elements, $point);
            $this->saveMajorIons($major_ions, $point);
            $this->saveOrganicSubstances($organic_substances, $point);
            DB::commit();
            return ['message' => 'success', 'status'=> 200];
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'status'=> 500];
        }
    }
    public function saveElements(array $elements, Point $point): void
    {
        foreach($elements as $key => $item)
        {
            PointElement::create([
                'point_id' => $point->id,
                'element_id' => $key,
                'item' => $item
            ]);
        }
    }

    public function saveMajorIons(array $major_ions, Point $point): void
    {
        foreach($major_ions as $key => $item)
        {
            PointMajorIon::create([
                'point_id' => $point->id,
                'ion_id' => $key,
                'item' => $item
            ]);
        }

    }

    public function saveOrganicSubstances(array $organic_substances, Point $point)
    {
        foreach($organic_substances as $key => $item)
        {
            PointOrganicSubstance::create([
                'point_id' => $point->id,
                'organic_substance_id' => $key,
                'item' => $item
            ]);
        }

    }
}
