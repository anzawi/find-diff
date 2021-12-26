<?php

namespace Anzawi\App;

use Anzawi\FindDiff\Hamming;
use Anzawi\FindDiff\Levenshtein;

class Action
{
    private bool $submit = false;
    private bool $errors = true;
    private int $levenshtein = 0;
    private int $hamming = 0;
    private string $firstString = '';
    private string $secondString = '';


    /**
     * set strings values
     * @param  string  $firstString
     * @param  string  $secondString
     */
    public function set(string $firstString, string $secondString)
    {
        $this->firstString = $firstString;
        $this->secondString = $secondString;
    }

    /**
     * set levenshtein & hamming values
     */
    public function run(): void
    {
        $this->submit = true;
        $this->setLevenshtein();
        $this->setHamming();
    }

    /**
     * check if user submit form
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return $this->submit;
    }

    /**
     * check if there is any error
     * @return bool
     */
    public function errors(): bool
    {
        return !$this->errors;
    }

    /**
     * validate user input
     * @return bool
     */
    public function validate(): bool
    {
        if (empty($this->firstString) || empty($this->secondString))
            return $this->errors = false;

        return $this->errors = true;
    }

    /**
     * return levenshtein
     * @return int
     */
    public function getLevenshtein(): int
    {
        return $this->levenshtein;
    }

    /**
     * get differnce between strings
     * @return array
     */
    public function getDiff(): array
    {
        return Levenshtein::getDiff($this->firstString, $this->secondString);
    }

    /**
     * return hamming
     * @return int
     *
     */
    public function getHamming(): int
    {
        return $this->hamming;
    }

    /**
     * set levenshtein distance
     */
    private function setLevenshtein(): void
    {
        $this->levenshtein = Levenshtein::findDiff($this->firstString, $this->secondString);
    }

    /**
     * * set hamming distance
     */
    private function setHamming(): void
    {
        $this->hamming = Hamming::calculate($this->firstString, $this->secondString);
    }

    /**
     * @return string
     */
    public function getFirstString()
    {
        return $this->firstString;
    }

    /**
     * @return string
     */
    public function getSecondString()
    {
        return $this->secondString;
    }
}