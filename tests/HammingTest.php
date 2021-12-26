<?php

namespace Anzawi\FindDiff;

use PHPUnit\Framework\TestCase;

class HammingTest extends TestCase
{
    protected string $firstString = "this is a test";
    protected string $secondString = "this is test";

    public  function testCalculate()
    {
        $hamming = Hamming::calculate($this->firstString, $this->secondString);
        $this->assertIsInt($hamming);
        $this->assertEquals(4, $hamming);
    }
}
