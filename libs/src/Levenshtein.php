<?php

namespace Anzawi\FindDiff;

class Levenshtein
{
    /**
     * Calculate Levenshtein distance between two strings
     * Note: In its simplest form the function will take only the two strings
     * as parameter and will calculate just the number of insert, replace and
     * delete operations needed to transform firstString into secondString.
     * Note: A second variant will take three additional parameters that define
     * the cost of insert, replace and delete operations. This is more general
     * and adaptive than variant one, but not as efficient.
     * @param string $firstString One of the strings being evaluated for Levenshtein distance.
     * @param string $secondString One of the strings being evaluated for Levenshtein distance.
     * @param int $costIns [optional] Defines the cost of insertion.
     * @param int $costRep [optional] Defines the cost of replacement.
     * @param int $costDel [optional] Defines the cost of deletion.
     * @return int
     */
    public static function findDiff(string $firstString, string $secondString, int $costIns = 1, int $costRep = 1, int $costDel = 1): int
    {
        /*
         * get strings lengths
         */
        $firstStringLength = strlen($firstString);
        $secondStringLength = strlen($secondString);

        // throw exception if any string length grater than MAX_STRINGS_LENGTH (255)
        if ($firstStringLength > self::MAX_STRINGS_LENGTH || $secondStringLength > self::MAX_STRINGS_LENGTH) {
            throw new \LogicException("max strings length is '" . self::MAX_STRINGS_LENGTH . "' '$firstStringLength', '$secondString' gavin!");
        }

        /*
         * check if first string length is [0]
         * return second string length multiplied with cost of insertion
         */
        if ($firstStringLength == 0) {
            return $secondStringLength * $costIns;
        }

        /*
         * check if second string length is [0]
         * return first string length multiplied with cost of deletion
         */
        if ($secondStringLength == 0) {
            return $firstStringLength * $costDel;
        }

        $paragraph1 = [];
        $paragraph2 = [];

        // initial boundary conditions
        for ($i2 = 0; $i2 <= $secondStringLength; $i2++) {
            $paragraph1[$i2] = $i2 * $costIns;
        }

        // calculate the edit distance
        for ($i1 = 0; $i1 < $firstStringLength; $i1++) {
            $paragraph2[0] = $paragraph1[0] + $costDel;

            for ($i2 = 0; $i2 < $secondStringLength; $i2++) {
                $c0 = $paragraph1[$i2] + (($firstString[$i1] == $secondString[$i2]) ? 0 : $costRep);
                $c1 = $paragraph1[$i2 + 1] + $costDel;
                if ($c1 < $c0) {
                    $c0 = $c1;
                }
                $c2 = $paragraph2[$i2] + $costIns;
                if ($c2 < $c0) {
                    $c0 = $c2;
                }
                $paragraph2[$i2 + 1] = $c0;
            }
            $tmp = $paragraph1;
            $paragraph1 = $paragraph2;
            $paragraph2 = $tmp;
        }

        return $paragraph1[$secondStringLength];
    }
    private const MAX_STRINGS_LENGTH = 255;

    /**
     * Get strings different to render in html page
     * @param  string  $firstString
     * @param  string  $secondString
     * @return string[]
     */
    public static function getDiff(string $firstString, string $secondString)
    {
        $fromStart = strspn($firstString ^ $secondString, "\0");
        $fromEnd = strspn(strrev($firstString) ^ strrev($secondString), "\0");
        $firstStringEnd = strlen($firstString) - $fromEnd;
        $secondStringEnd = strlen($secondString) - $fromEnd;

        $start = substr($secondString, 0, $fromStart);
        $end = substr($secondString, $secondStringEnd);
        $secondStringDiff = substr($secondString, $fromStart, $secondStringEnd - $fromStart);
        $firstStringDiff = substr($firstString, $fromStart, $firstStringEnd - $fromStart);

        $secondString = "$start<ins style='background-color:#ccffcc'>$secondStringDiff</ins>$end";
        $firstString = "$start<del style='background-color:#ffcccc'>$firstStringDiff</del>$end";
        return [
            "first_string" => $firstString,
            "second_string" => $secondString,
        ];
    }
}