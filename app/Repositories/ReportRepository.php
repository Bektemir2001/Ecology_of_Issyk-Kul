<?php

namespace App\Repositories;

use App\Models\Field;

class ReportRepository
{
    public function fields()
    {
        $fields = Field::select('field', 'model', 'table_field');
        $fields->each(function ($value){
            if($value->model)
            {
                $model = app()->getNamespace() . 'Models\\' . $value->model;
                $value->children = $model::all();
            }
        });
        return $fields;
    }
}
