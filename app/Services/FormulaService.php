<?php

namespace App\Services;

class FormulaService
{
    public function formula1($chlA)
    {
        return 2.22 + 2.54 * log($chlA);
    }
    public function formula2($sd)
    {
        return 5.10 + 2.60 * log(1 / $sd - 1 / 40);
    }
    public function formula3($tp)
    {
        return 0.218 + 2.92 * log($tp);
    }
    public function formula4($tn)
    {
        return -3.61 + 3.01 * log($tn);
    }
    public function formula5($item)
    {

    }
    public function formula6($item)
    {

    }
}
