<?php

namespace YouTube\Tests;

use PHPUnit\Framework\TestCase;
use YouTube\Utils;

class ArrayTest extends TestCase
{
    protected $array = [
        'one' => [
            'two' => ['three' => 33]
        ],
        'simple' => [1, 2, 3],
        'one_2' => 12,
        1,
        2,
        3
    ];

    public function test_array_get()
    {
        $this->assertEquals(33, Utils::arrayGet($this->array, "one.two.three", "default"));
    }

    public function test_when_value_is_array()
    {
        $this->assertEquals([1, 2, 3], Utils::arrayGet($this->array, 'simple'));
    }

    public function test_non_existing_index()
    {
        $this->assertEquals("default", Utils::arrayGet($this->array, "one.two.four", "default"));
        $this->assertEquals(null, Utils::arrayGet($this->array, "one.two.four"));
    }

    public function test_deeper_level_than_exists()
    {
        $this->assertEquals(null, Utils::arrayGet($this->array, "one.two.three.four"));
    }
}