<?php

namespace Anzawi\FindDiff;

use PHPUnit\Framework\TestCase;

class LevenshteinTest extends TestCase
{
    protected string $firstString = "this is a test";
    protected string $secondString = "this is test";

    public function testGetDiff()
    {
        $diff = Levenshtein::getDiff($this->firstString, $this->secondString);
        $this->assertIsArray($diff);
    }

    public function testFindDiff()
    {
        $diff = Levenshtein::findDiff($this->firstString, $this->secondString);
        $this->assertIsInt($diff);
        $this->assertEquals(2, $diff);
    }
}
