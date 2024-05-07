<?php

namespace App\Services\Operator;

use App\Models\Element;
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
            $element = Element::where('id', $key)->first();
            if($element->parentElement)
            {
                $parent_point_element = PointElement::where('element_id', '=', $element->parentElement->id)
                    ->where('point_id', $point->id)
                    ->first();
                if($parent_point_element)
                {
                    $parent_point_element->update(['item' => $parent_point_element->item + $item]);
                }
                else{
                    PointElement::create([
                        'point_id' => $point->id,
                        'element_id' => $element->parentElement->id,
                        'item' => $item
                    ]);
                }
            }

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

    public function clearPoint(Point $point): void
    {
        foreach ($point->pointElements as $pointElement) {
            $pointElement->delete();
        }
        foreach ($point->pointOrganics as $pointOrganic) {
            $pointOrganic->delete();
        }
        foreach ($point->pointIons as $pointIon) {
            $pointIon->delete();
        }
    }

    public function addElements(array $elements, array $ions, array $organics, Point $point): void
    {
        foreach ($elements as $key => $item) {
            PointElement::query()->create([
                'element_id' => $key,
                'point_id' => $point->id,
                'item' => $item
            ]);
            $element = Element::where('id', $key)->first();
            if($element->parentElement)
            {
                $parent_point_element = PointElement::where('element_id', '=', $element->parentElement->id)
                    ->where('point_id', $point->id)
                    ->first();
                if($parent_point_element)
                {
                    $parent_point_element->update(['item' => $parent_point_element->item + $item]);
                }
                else{
                    PointElement::create([
                        'point_id' => $point->id,
                        'element_id' => $element->parentElement->id,
                        'item' => $item
                    ]);
                }
            }
        }
        foreach ($ions as $key => $item) {
            PointMajorIon::query()->create([
                'ion_id' => $key,
                'point_id' => $point->id,
                'item' => $item
            ]);
        }
        foreach ($organics as $key => $item) {
            PointOrganicSubstance::query()->create([
                'organic_substance_id' => $key,
                'point_id' => $point->id,
                'item' => $item
            ]);
        }
    }
}
