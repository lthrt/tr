<?php

namespace TRBundle\Tests\Model;

use TRBundle\Model\WaveResolver;
use TRBundle\Tests\TestWithFixtures;

class WaveResolverTest extends TestWithFixtures
{
    private $all = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34];

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

    private $dogsMajority  = [2, 3, 6, 12, 28];
    private $pigsMajority  = [4, 7, 8, 16, 31];
    private $sheepMajority = [10, 19, 20, 22, 33];

    private $dogsMinority  = [14, 17, 23, 26, 27];
    private $sheepMinority = [14, 15, 17, 18, 27];

    private $dogsPlurality  = [2, 3, 5, 6, 9, 11, 12, 14, 15, 18, 21, 24, 27, 28, 29, 30];
    private $pigsPlurality  = [4, 5, 7, 8, 9, 13, 14, 16, 17, 18, 25, 26, 27, 29, 31, 32];
    private $sheepPlurality = [10, 11, 13, 14, 19, 20, 21, 22, 23, 24, 25, 26, 27, 30, 32, 33];

    private $fewerPigsThanSheep = [10, 11, 12, 19, 20, 21, 22, 23, 24, 30, 33];

    private $moreDogsThanPigs  = [2, 3, 6, 11, 12, 15, 20, 21, 24, 28, 30];
    private $morePigsThanDogs  = [4, 7, 8, 13, 16, 17, 22, 25, 26, 31, 32];
    private $morePigsThanSheep = [4, 5, 6, 7, 8, 9, 16, 17, 18, 29, 31];
    private $moreSheepThanDogs = [10, 13, 16, 19, 20, 22, 23, 25, 26, 32, 33];

/////////Below here have notbeen tested yet

    private $pigsMinority = [14, 17, 23, 26, 27];

    // $resolve = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34];

    private $resolver;
    private $game;

    public function setUp()
    {
        parent::setUp();
        $this->game     = self::$em->getRepository('TRBundle:Game')->findOneByDescription('TestData');
        $this->resolver = new WaveResolver(self::$em, $this->game);
    }

    public function testIsThisThingOn()
    {
        $this->assertTrue(true);
    }

    public function testSinkingTheLusitania()
    {
        $eigenfunctionResolutions = [
            'US Enters the Great War' => $this->dogsPlurality,
            'US Avoids the Great War' => $this->moreSheepThanDogs,
        ];

        $this->evaluateResult('Sinking the Lusitania', $eigenfunctionResolutions);
    }

    public function testTreatyOfVersailles()
    {
        $eigenfunctionResolutions = [
            'Germany Loses the Great War'      => $this->dogsPlurality,
            'Germany Stalemates the Great War' => $this->fewerPigsThanSheep,
            'Germany Wins the Great War'       => $this->dogsMinority,
        ];

        $this->evaluateResult('Treaty of Versailles', $eigenfunctionResolutions);

    }

    public function testWeimarEconomy()
    {
        $eigenfunctionResolutions = [
            'Weimar Boom'           => $this->pigsPlurality,
            'Weimar Recession'      => $this->morePigsThanDogs,
            'Weimar Depression'     => $this->morePigsThanSheep,
            'Weimar Hyperinflation' => $this->sheepPlurality,
        ];

        $this->evaluateResult('Weimar Economy', $eigenfunctionResolutions);

    }

    public function testGermanRecovery()
    {
        $eigenfunctionResolutions = [
            'German Autocracy'   => $this->pigsMajority,
            'German Fascism'     => $this->dogsPlurality,
            'German Nationalism' => $this->pigsPlurality,
            'German Populism'    => $this->sheepMinority,
            'German Socialism'   => $this->sheepPlurality,
        ];

        $this->evaluateResult('German Recovery', $eigenfunctionResolutions);
    }

    public function testTheRussoGermanAlliance()
    {
        $eigenfunctionResolutions = [
            'Germany does not attack Russia' => $this->sheepPlurality,
            'Germany attacks Russia'         => $this->dogsPlurality,
            'Russia declares war on Britain' => $this->dogsMajority,
        ];

        $this->evaluateResult('The Russo-German Alliance', $eigenfunctionResolutions);
    }

    public function testTheNippoRussoGermanAlliance()
    {
        $eigenfunctionResolutions = [
            'Germany does not honor alliance with Japan' => $this->pigsMajority,
            'Germany declares war on US'                 => $this->dogsPlurality,
        ];

        $this->evaluateResult('The Nippo-German Alliance', $eigenfunctionResolutions);
    }

    public function testWWIIEnds()
    {
        $eigenfunctionResolutions = [
            'Decisive German Victory in WW II' => $this->pigsPlurality,
            'Marginal German Victory in WW II' => $this->dogsMinority,
            'Marginal German Defeat in WW II'  => $this->sheepMajority,
            'Decisive German Defeat in WW II'  => $this->sheepPlurality,
        ];

        $this->evaluateResult('WW II Ends', $eigenfunctionResolutions);
    }

    public function testGermanAtomics()
    {
        $eigenfunctionResolutions = [
            'Germany builds the Bomb'   => $this->pigsMajority,
            'Germany abandons the Bomb' => $this->sheepPlurality,
        ];

        $this->evaluateResult('German Atomics', $eigenfunctionResolutions);
    }

    public function testUSHegemony()
    {
        $eigenfunctionResolutions = [
            'US Obliterates Europe'              => $this->sheepMinority,
            'US Establishes Strategic Deterrent' => $this->pigsPlurality,
        ];

        $this->evaluateResult('US Hegemony', $eigenfunctionResolutions, true);
    }

    public function testTheGermanColdWar()
    {
        $eigenfunctionResolutions = [
            'Germany Wins Cold War'       => $this->pigsPlurality,
            'Germany Stalemates Cold War' => $this->morePigsThanDogs,
            'Germany Loses Cold War'      => $this->moreDogsThanPigs,
            'Limited Exchange'            => $this->sheepMinority,
        ];

        $this->evaluateResult('The German Cold War', $eigenfunctionResolutions);
    }

    public function testTheSuccession()
    {
        $eigenfunctionResolutions = [
            'Fuhrer is succeeded'    => $this->pigsPlurality,
            'Fuhrer is assassinated' => $this->dogsMajority,
        ];

        $this->evaluateResult('The Succession', $eigenfunctionResolutions);
    }

    public function evaluateResult(
        $wave,
        $eigenfunctionResolutions,
        $game = false
    ) {
        $wave = static::$em->getRepository('TRBundle:Wave')->findOneByDescription($wave);
        foreach (array_keys($eigenfunctionResolutions) as $desc) {
            $eigenfunctions[$desc] = static::$em->getRepository('TRBundle:Eigenfunction')->findOneBy(['description' => $desc]);
            $states[$desc]         = static::$em->getRepository('TRBundle:State')->findOneBy([
                'eigenfunction' => $eigenfunctions[$desc],
                'game'          => $this->game,
            ]);
        }

        foreach ($states as $state) {
            array_walk($states, function ($s) {$s->setResources();});
            foreach ($eigenfunctions as $eigenfunction) {
                foreach ($this->resources as $key => $resource) {
                    $state->setResources($resource);
                    if (in_array($key, $eigenfunctionResolutions[$eigenfunction->description])) {
                        $this->assertContains(
                            $eigenfunction->description,
                            array_values($this->resolver->resolveWave($this->game, $wave)),
                            "Delete key " . $key . " from " . $eigenfunction->description . "/" . $eigenfunction->trigger . "\n"
                        );
                        $this->assertContains(
                            $eigenfunction->description,
                            array_values($this->resolver->resolveFromState($state, $wave)),
                            "Delete key " . $key . " from " . $eigenfunction->description . "/" . $eigenfunction->trigger . "\n"
                        );
                        if ($game) {
                            $this->assertContains(
                                $eigenfunction->description,
                                array_values($this->resolver->resolveGame($this->game)),
                                "Delete key " . $key . " from " . $eigenfunction->description . "/" . $eigenfunction->trigger . "\n"
                            );
                        }
                    }
                    if (in_array($key, array_diff($this->all, $eigenfunctionResolutions[$eigenfunction->description]))) {
                        $this->assertNotContains(
                            $eigenfunction->description,
                            array_values($this->resolver->resolveWave($this->game, $wave)),
                            "Add key " . $key . " to " . $eigenfunction->description . "/" . $eigenfunction->trigger . "\n"
                        );
                        $this->assertNotContains(
                            $eigenfunction->description,
                            array_values($this->resolver->resolveFromState($state, $wave)),
                            "Add key " . $key . " to " . $eigenfunction->description . "/" . $eigenfunction->trigger . "\n"
                        );
                    }
                }
            }
        }
    }
}
