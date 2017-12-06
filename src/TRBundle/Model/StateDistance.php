<?php

namespace TRBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use TRBundle\Entity\Game;
use TRBundle\Entity\State;

class StateDistance extends WebTestCase
{
    private $em;
    private $game;

    public function __construct(
        EntityManagerInterface $em,
                               $game
    ) {
        $this->em   = $em;
        $this->game = $game;
    }

    public function distance(
        $source,
        $target
    ) {
        // by text string

        // Bailout for identity
        if ($source == $target) {
            return 0;
        } else {
            $src = $this->em->getRepository('TRBundle:Eigenfunction')->findOneByDescription($source);
            $src = $this->em->getRepository('TRBundle:State')->findOneBy(['eigenfunction' => $src, 'game' => $this->game]);
            $tgt = $this->em->getRepository('TRBundle:Eigenfunction')->findOneByDescription($target);
            $tgt = $this->em->getRepository('TRBundle:State')->findOneBy(['eigenfunction' => $tgt, 'game' => $this->game]);
            return $this->dist($src, $tgt);
        }
    }

    public function dist(
        State $src,
        State $tgt

    ) {
        // By entity

        if ($src->id == $tgt->id) {return 0;}
        $playerLocations = $this->em->getRepository('TRBundle:State')->getPlayerLocations($this->game);

        // Bailout for end position occupied
        // strict in_array reequired ('true')
        if (in_array($tgt, $playerLocations, true)) {return null;}

        // Bailout for same wave
        if ($src->eigenfunction->wave->id == $tgt->eigenfunction->wave->id) {return 1;}

        // Rectify wave direction so search is one-way
        // src is closests to earliest event
        // assume path is reversible
        $loc      = $tgt;
        $tgtIndex = 0;
        while ($loc->prev->first()) {
            ++$tgtIndex;
            $loc = $loc->prev->first();
        }

        $loc      = $src;
        $srcIndex = 0;
        while ($loc->prev->first()) {
            ++$srcIndex;
            $loc = $loc->prev->first();
        }

        if ($tgtIndex < $srcIndex) {
            $dir = 'prev';
        } else {
            $dir = 'next';
        }

        $waveFound = false;
        $active    = [$src->eigenfunction->id . "" => $src];

        $forward = [];
        $i       = 0;
        // echo ($src->eigenfunction->wave->id . '->' . $tgt->eigenfunction->wave->id . "started----------\n");

        while ($active && !$waveFound) {
            // var_dump(array_keys($active));
            foreach ($active as $ind => $vertex) {
                foreach ($vertex->$dir as $node) {
                    // don't add if players present
                    // strict in_array reequired ('true')
                    if (!in_array($node, $playerLocations, true)) {
                        // have to get id because of lazy loading--
                        // sometimes the objects are not fully hydrated
                        $nodeWave = $node->eigenfunction->wave->id;
                        $tgtWave  = $tgt->eigenfunction->wave->id;
                        if ($nodeWave === $tgtWave) {
                            $waveFound = true;
                        }
                        $mod = $node->closed ? '+' : '';

                        if (
                            $nodeWave === $tgtWave &&
                            ($node->eigenfunction->id != $tgt->eigenfunction->id)
                        ) {
                            $mod .= "*";
                            $tgtMod = $tgt->closed ? '+' : '';
                            $newInd = $ind . '~' . $node->eigenfunction->id . $mod . '~' . $tgt->eigenfunction->id . $tgtMod;

                        } else {
                            $newInd = $ind . '~' . $node->eigenfunction->id . $mod;
                        }

                        $active[$newInd]  = $node;
                        $forward[$newInd] = true;
                    } else {
                    }
                }

                $newActive = array_filter($active, function ($e) use ($vertex) {return $e->id != $vertex->id;});
                $active = $newActive;
            }
        }
        // echo ($src->eigenfunction->wave->id . '->' . $tgt->eigenfunction->wave->id . " finished=================\n");

        $map =
            array_filter(
            array_keys($forward),
            function ($item) use ($src, $tgt) {
                return (
                    in_array($src->eigenfunction->id, explode("~", $item)) &&
                    in_array($tgt->eigenfunction->id, explode("~", $item))
                );
            }
        );

        $paths = [];
        foreach ($map as $path) {
            $paths[$path] = substr_count($path, '+') + substr_count($path, '~');
        }
        // var_dump([$src->eigenfunction->id, $tgt->eigenfunction->id, $paths]);

        return $paths ? min(array_values($paths)) : null;
    }

    public function withinRange(
        State $state,
              $range
    ) {
        return [];
    }
}
