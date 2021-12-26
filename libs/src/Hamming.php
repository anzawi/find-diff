<?php

namespace Anzawi\FindDiff;

class Hamming
{
    /**
     * Calculate Hamming distance between two strings
     * Note: In its simplest form the function will take only the two strings
     * as parameter and will calculate just the number
     * @param string $firstString One of the strings being evaluated for Hamming distance.
     * @param string $secondString One of the strings being evaluated for Hamming distance.
     * @return int
     */
    public static function calculate(string $firstString, string $secondString): int
    {
        $i = 0;
        $count = 0;
        while (isset($firstString[$i]) != '') {
            if (isset($firstString[$i]) && isset($secondString[$i])) {
                if ($firstString[$i] != $secondString[$i]) {
                    $count++;
                }
            }
            $i++;
        }
        return $count;
    }
}