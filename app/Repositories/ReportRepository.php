<?php

namespace App\Repositories;

use App\Models\Field;

class ReportRepository
{
    public function fields()
    {
        $fields = Field::all();
        $fields->each(function ($value){
            if($value->model)
            {
                $model = app()->getNamespace() . $value->model;
                $value->children = $model::all();
            }
        });
        return $fields;
    }
}
