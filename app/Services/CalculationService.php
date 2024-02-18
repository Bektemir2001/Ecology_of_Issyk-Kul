<?php

namespace App\Services;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class CalculationService
{
    public function calculate(string $formula, float $item)
    {
        $expressionLanguage = new ExpressionLanguage();
        $result = $expressionLanguage->evaluate($formula, ['item' => $item]);
        return $result;
    }
}
