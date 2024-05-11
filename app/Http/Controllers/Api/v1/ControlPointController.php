<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Http\Resources\ControlPointResource;
use App\Models\ControlPoint;
use App\Models\Element;
use App\Models\Field;
use Carbon\Carbon;


class ControlPointController extends Controller
{
    public function getAll()
    {
        return ControlPointResource::collection(ControlPoint::all()->each(function ($controlPoint) {
            $controlPoint->setAttribute('color', '#000');
        }));
    }

    public function getWithPDK(ReportRequest $request)
    {
        $data = $request->validated();
        $control_points = ControlPoint::all();
        $year = $data['year'];
        $table_field = $data["table_field"];
        $pdk = Field::query()->where('table_field', $table_field)->first();
        if(array_key_exists('children', $data)) {
            if($data['table_field'] == 'elements')
            {
                $control_points = $this->elements($control_points, $data['children'], $year);
            }
            return ControlPointResource::collection($control_points);
        }



        $control_points->each(function ($item) use ($year, $table_field, $pdk) {
            $points = $item->points;
            $points = $points->filter(function ($point) use ($year) {
                $date = Carbon::createFromFormat('Y-m-d', $point->date);
                return $year == strval($date->year);
            });
            $value = $points->avg($table_field);
            $item->setAttribute('color', $this->getColor($value, $pdk->pdk_up));
        });
        return ControlPointResource::collection($control_points);
    }

    public function getColor($item, $pdk)
    {
        $colors = ['#000', '#32CD32', '#FFFF00', '#FF0000'];
        if($item == null || $pdk == null || $item == 0)
        {
            return $colors[0];
        }
        $avg = (($item - $pdk)/$pdk) * 100;
        if($avg <= 10 and $avg >= -10)
        {
            return $colors[1];
        }
        elseif($avg > 10)
        {
            return $colors[3];
        }
        else
        {
            return $colors[2];
        }
    }

    public function elements($control_points, $element_id, $year)
    {
        $pdk = Element::query()->where('id', $element_id)->first()->pdk_up;
        $control_points->each(function ($item) use ($year, $pdk, $element_id) {
            $points = $item->points;
            $points = $points->filter(function ($point) use ($year, $element_id) {
                $date = Carbon::createFromFormat('Y-m-d', $point->date);
                $point->element_item = $point->pointElements->where('element_id', $element_id)->avg('item');
                return $year == strval($date->year);
            });
            $value = $points->avg('element_item');
            $item->setAttribute('color', $this->getColor($value, $pdk->pdk_up));
        });
        return $control_points;
    }
    public function ions()
    {

    }

    public function organics()
    {

    }
}
