<?php

declare(strict_types=1);

namespace App\Service;

final class BMICalculatorService
{
    public function calculate(float $weight, float $height): float
    {
        return $weight / pow($height / 100, 2);
    }
}
