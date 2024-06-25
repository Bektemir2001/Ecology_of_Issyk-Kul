<?php

namespace App\Services;

use App\Models\ControlPoint;
use App\Models\TrophicStateIndex;

class TSIService
{

	public static $tsiClassifications;
	public static function calculateClassification($elements, $controlPoints)
	{
		$controlPoints_ids = $controlPoints->toArray();
		$controlPoints = ControlPoint::whereIn('id', $controlPoints_ids)->get();
		$result = [];
		for($i = 0; $i < count($controlPoints_ids); $i++)
		{
			$avg_tsi = 0;
			foreach ($elements as $element)
			{
				$avg_tsi += $element[$i];
			}
			$controlPoint = $controlPoints->where('id', $controlPoints_ids[$i])->first();
			$avg_tsi = round($avg_tsi/4, 3);
			$classification = self::getClassification($avg_tsi);
			$data = [
				'id' => $controlPoint->id,
				'name' => $controlPoint->name,
				'number' => $controlPoint->number,
				'X_coordinate' => $controlPoint->X_coordinate,
				'Y_coordinate' => $controlPoint->Y_coordinate,
				'tsi' => $avg_tsi,
				'classification' => $classification['name'],
				'color' => $classification['color'],
			];
			$result[] = $data;
		}

		return $result;
	}

	public static function getClassification($avg_tsi): array
	{
		$classifications = self::getClassifications();
		$result = '';
		foreach($classifications as $classification)
		{
			$result = ['name' => $classification->name, 'color' => $classification->color];
			if($avg_tsi <= intval($classification->item))
			{
				return ['name' => $classification->name, 'color' => $classification->color];
			}
		}

		return $result;
	}

	public static function getClassifications()
	{
		if(self::$tsiClassifications == null)
		{
			self::$tsiClassifications = TrophicStateIndex::all()->sortBy('item');
		}
		return self::$tsiClassifications;
	}
}