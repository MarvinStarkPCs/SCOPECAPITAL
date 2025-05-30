<?php

if (!function_exists('calculateCompoundInterest')) {
    /**
     * Calcula el monto final con interés compuesto.
     *
     * @param float $principal Monto inicial (P)
     * @param float $rate Tasa de interés anual (r), por ejemplo 0.05 para 5%
     * @param int $compoundingPeriods Número de períodos de capitalización por año (n)
     * @param int $time Tiempo en años (t)
     * @return float Monto final (A), redondeado a 2 decimales
     */
    function calculateCompoundInterest(float $principal, float $rate, int $compoundingPeriods, int $time): float
    {
        $amount = $principal * pow((1 + ($rate / $compoundingPeriods)), $compoundingPeriods * $time);
        return round($amount, 1);
    }
}
