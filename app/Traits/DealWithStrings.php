<?php

namespace App\Traits;

trait DealWithStrings
{

    /**
     * iliminate short words that i's long less than given number
     *
     * @param string $sentence
     * @param integer $min_long
     * @return string
     */
    public function iliminateShortWords(string $sentence, int $min_long = 3)
    {
        $words = explode(" ", $sentence);

        $words = array_filter($words, fn ($word) => strlen($word) > $min_long);

        return implode(" ", $words);
    }
}
