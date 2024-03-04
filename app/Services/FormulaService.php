<?php

namespace App\Services;

class FormulaService
{
    public function formula1($chlA)
    {
        return 2.22 + 2.54 * log10($chlA);
    }
    public function formula2($sd)
    {
        return 5.10 + 2.60 * log10(1 / $sd - 1 / 40);
    }
    public function formula3($tp)
    {
        return 0.218 + 2.92 * log10($tp);
    }
    public function formula4($tn)
    {
        return -3.61 + 3.01 * log10($tn);
    }
    public function formula5($item)
    {
        return 10 * (6 - ((2 - 0.68 * log($item)/log(2))));
    }
    public function formula6($item)
    {
        return 10 * (6 - ((log(48/$item)/log(2))));
    }

    public function formula7($item)
    {
        return 10 * (6 - (log($item)/log(2)));
    }
    public function formula8($item)
    {
        return 10 * (6 - (log(1.47/$item)/log(2)));
    }
}
