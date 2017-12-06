<?php

namespace TRBundle\Tests\Model;

use TRBundle\Model\ConditionResolver;
use TRBundle\Tests\TestWithFixtures;

class ConditionsResolverTest extends TestWithFixtures
{
    private $resolver;

    private $resources = [
        1  => ['dogs' => 0, 'pigs' => 0, 'sheep' => 0],
        2  => ['dogs' => 1, 'pigs' => 0, 'sheep' => 0],
        3  => ['dogs' => 2, 'pigs' => 0, 'sheep' => 0],
        4  => ['dogs' => 0, 'pigs' => 1, 'sheep' => 0],
        5  => ['dogs' => 1, 'pigs' => 1, 'sheep' => 0],
        6  => ['dogs' => 2, 'pigs' => 1, 'sheep' => 0],
        7  => ['dogs' => 0, 'pigs' => 2, 'sheep' => 0],
        8  => ['dogs' => 1, 'pigs' => 2, 'sheep' => 0],
        9  => ['dogs' => 2, 'pigs' => 2, 'sheep' => 0],
        10 => ['dogs' => 0, 'pigs' => 0, 'sheep' => 1],
        11 => ['dogs' => 1, 'pigs' => 0, 'sheep' => 1],
        12 => ['dogs' => 2, 'pigs' => 0, 'sheep' => 1],
        13 => ['dogs' => 0, 'pigs' => 1, 'sheep' => 1],
        14 => ['dogs' => 1, 'pigs' => 1, 'sheep' => 1],
        15 => ['dogs' => 2, 'pigs' => 1, 'sheep' => 1],
        16 => ['dogs' => 0, 'pigs' => 2, 'sheep' => 1],
        17 => ['dogs' => 1, 'pigs' => 2, 'sheep' => 1],
        18 => ['dogs' => 2, 'pigs' => 2, 'sheep' => 1],
        19 => ['dogs' => 0, 'pigs' => 0, 'sheep' => 2],
        20 => ['dogs' => 1, 'pigs' => 0, 'sheep' => 2],
        21 => ['dogs' => 2, 'pigs' => 0, 'sheep' => 2],
        22 => ['dogs' => 0, 'pigs' => 1, 'sheep' => 2],
        23 => ['dogs' => 1, 'pigs' => 1, 'sheep' => 2],
        24 => ['dogs' => 2, 'pigs' => 1, 'sheep' => 2],
        25 => ['dogs' => 0, 'pigs' => 2, 'sheep' => 2],
        26 => ['dogs' => 1, 'pigs' => 2, 'sheep' => 2],
        27 => ['dogs' => 2, 'pigs' => 2, 'sheep' => 2],
        28 => ['dogs' => 1],
        29 => ['dogs' => 1, 'pigs' => 1],
        30 => ['dogs' => 1, 'sheep' => 1],
        31 => ['pigs' => 1],
        32 => ['pigs' => 1, 'sheep' => 1],
        33 => ['sheep' => 1],
        34 => [],
    ];

    public function setUp()
    {
        parent::setUp();
        $this->resolver = new ConditionResolver();
    }

    public function testIsThisThingOn()
    {
        $this->assertTrue(true);
    }

    public function testMoreDogsThanPigs()
    {
        $falses = [1, 4, 5, 7, 8, 9, 10, 13, 14, 16, 17, 18, 19, 22, 23, 25, 26, 27, 29, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->moreDogsThanPigs($resource));
            } else {
                $this->assertTrue($this->resolver->moreDogsThanPigs($resource));
            }
        }
    }

    public function testMoreDogsThanSheep()
    {
        $falses = [1, 4, 7, 10, 11, 13, 14, 16, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 30, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->moreDogsThanSheep($resource));
            } else {
                $this->assertTrue($this->resolver->moreDogsThanSheep($resource));
            }
        }
    }

    public function testMorePigsThanDogs()
    {
        $falses = [1, 2, 3, 5, 6, 9, 10, 11, 12, 14, 15, 18, 19, 20, 21, 23, 24, 27, 28, 29, 30, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->morePigsThanDogs($resource));
            } else {
                $this->assertTrue($this->resolver->morePigsThanDogs($resource));
            }
        }
    }

    public function testMorePigsThanSheep()
    {
        $falses = [1, 2, 3, 10, 11, 12, 13, 14, 15, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 30, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->morePigsThanSheep($resource));
            } else {
                $this->assertTrue($this->resolver->morePigsThanSheep($resource));
            }
        }
    }

    public function testMoreSheepThanDogs()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 14, 15, 17, 18, 21, 24, 27, 28, 29, 30, 31, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->moreSheepThanDogs($resource));
            } else {
                $this->assertTrue($this->resolver->moreSheepThanDogs($resource));
            }
        }
    }
    public function testMoreSheepThanPigs()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 13, 14, 15, 16, 17, 18, 25, 26, 27, 28, 29, 31, 32, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->moreSheepThanPigs($resource));
            } else {
                $this->assertTrue($this->resolver->moreSheepThanPigs($resource));
            }
        }
    }

    public function testFewerDogsThanPigs()
    {
        $falses = [1, 2, 3, 5, 6, 9, 10, 11, 12, 14, 15, 18, 19, 20, 21, 23, 24, 27, 28, 29, 30, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->fewerDogsThanPigs($resource));
            } else {
                $this->assertTrue($this->resolver->fewerDogsThanPigs($resource));
            }
        }
    }

    public function testFewerDogsThanSheep()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 14, 15, 17, 18, 21, 24, 27, 28, 29, 30, 31, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->fewerDogsThanSheep($resource));
            } else {
                $this->assertTrue($this->resolver->fewerDogsThanSheep($resource));
            }
        }
    }

    public function testFewerPigsThanDogs()
    {
        $falses = [1, 4, 5, 7, 8, 9, 10, 13, 14, 16, 17, 18, 19, 22, 23, 25, 26, 27, 29, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->fewerPigsThanDogs($resource));
            } else {
                $this->assertTrue($this->resolver->fewerPigsThanDogs($resource));
            }
        }
    }

    public function testFewerPigsThanSheep()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 13, 14, 15, 16, 17, 18, 25, 26, 27, 28, 29, 31, 32, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->fewerPigsThanSheep($resource));
            } else {
                $this->assertTrue($this->resolver->fewerPigsThanSheep($resource));
            }
        }
    }

    public function testFewerSheepThanPigs()
    {
        $falses = [1, 2, 3, 10, 11, 12, 13, 14, 15, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 30, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->fewerSheepThanPigs($resource));
            } else {
                $this->assertTrue($this->resolver->fewerSheepThanPigs($resource));
            }
        }
    }

    public function testFewerSheepThanDogs()
    {
        $falses = [1, 4, 7, 10, 11, 13, 14, 16, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 30, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->fewerSheepThanDogs($resource));
            } else {
                $this->assertTrue($this->resolver->fewerSheepThanDogs($resource));
            }
        }
    }

    public function testDogsMajority()
    {
        $falses = [1, 4, 5, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 29, 30, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->dogsMajority($resource));
            } else {
                $this->assertTrue($this->resolver->dogsMajority($resource));
            }
        }
    }

    public function testPigsMajority()
    {
        $falses = [1, 2, 3, 5, 6, 9, 10, 11, 12, 13, 14, 15, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->pigsMajority($resource));
            } else {
                $this->assertTrue($this->resolver->pigsMajority($resource));
            }
        }
    }

    public function testSheepMajority()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16, 17, 18, 21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->sheepMajority($resource));
            } else {
                $this->assertTrue($this->resolver->sheepMajority($resource));
            }
        }
    }

    public function testDogsMinority()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 18, 19, 20, 21, 22, 24, 25, 28, 29, 30, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->dogsMinority($resource));
            } else {
                $this->assertTrue($this->resolver->dogsMinority($resource));
            }
        }
    }

    public function testPigsMinority()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 16, 17, 18, 19, 20, 21, 22, 25, 26, 28, 29, 30, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->pigsMinority($resource));
            } else {
                $this->assertTrue($this->resolver->pigsMinority($resource));
            }
        }
    }

    public function testSheepMinority()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 16, 19, 20, 21, 22, 23, 24, 25, 26, 28, 29, 30, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->sheepMinority($resource));
            } else {
                $this->assertTrue($this->resolver->sheepMinority($resource));
            }
        }
    }

    public function testDogsPlurality()
    {
        $falses = [1, 4, 7, 8, 10, 13, 16, 17, 19, 20, 22, 23, 25, 26, 31, 32, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->dogsPlurality($resource));
            } else {
                $this->assertTrue($this->resolver->dogsPlurality($resource));
            }
        }
    }

    public function testPigsPlurality()
    {
        $falses = [1, 2, 3, 6, 10, 11, 12, 15, 19, 20, 21, 22, 23, 24, 28, 30, 33, 34];
        foreach ($this->resources as $key => $resource) {
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->pigsPlurality($resource));
            } else {
                $this->assertTrue($this->resolver->pigsPlurality($resource));
            }
        }
    }

    public function testSheepPlurality()
    {
        $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 12, 15, 16, 17, 18, 28, 29, 31, 34];
        foreach ($this->resources as $key => $resource) {
            // echo (__FUNCTION__ . ": " . $key . "\n");
            if (in_array($key, $falses)) {
                $this->assertFalse($this->resolver->sheepPlurality($resource));
            } else {
                $this->assertTrue($this->resolver->sheepPlurality($resource));
            }
        }
    }

    // $falses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34];
}
