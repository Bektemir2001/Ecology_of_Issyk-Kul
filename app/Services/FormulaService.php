<?php

namespace App\Services;

use DivisionByZeroError;
use Exception;

class FormulaService
{
    public function formula1($chlA)
    {

        try {
            return 2.22 + 2.54 * log10($chlA);
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }
    public function formula2($sd)
    {

        try {
            return 5.10 + 2.60 * log10((1 / $sd) - (1 / 40));
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }
    public function formula3($tp)
    {

        try {
            return 0.218 + 2.92 * log10($tp);
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }
    public function formula4($tn)
    {

        try {
            return -3.61 + 3.01 * log10($tn);
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }
    public function formula5($item)
    {

        try {
            return 10 * (6 - ((2.04 - 0.68 * log($item)/log(2))));
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }
    public function formula6($item)
    {

        try {
            return 10 * (6 - ((log(48/$item)/log(2))));
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }

    public function formula7($item)
    {

        try {
            return 10 * (6 - (log($item)/log(2)));
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }
    }
    public function formula8($item)
    {
        try {
            $result = 10 * (6 - (log(1.47/$item)/log(2)));
            return $result;
        }
        catch (DivisionByZeroError $e) {
            throw new Exception($e);
        }

    }
}
