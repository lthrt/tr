<?php

namespace TRBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use TRBundle\Entity\Game;
use TRBundle\Entity\State;
use TRBundle\Entity\Wave;
use TRBundle\Model\ConditionResolver;

class WaveResolver
{
    private $em;
    private $game;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function resolveFromState(State $state)
    {
        return $this->resolveWave($state->game, $state->eigenfunction->wave);
    }

    public function resolveGame(Game $game)
    {
        $waves    = $this->em->getRepository('TRBundle:Wave')->findAll();
        $resolved = [];
        foreach ($waves as $wave) {
            $resolved[] = $this->resolveWave($game, $wave);
        }

        $result = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($resolved));

        $resolutions = iterator_to_array($result, false);

        return $resolutions;
    }

    public function resolveWave(
        Game $game,
        Wave $wave
    ) {
        $eigenfunctions = $this->em->getRepository('TRBundle:Eigenfunction')->findByWave($wave);
        $qb             = $this->em->getRepository('TRBundle:State')->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.game', ':game'));
        $qb->andWhere($qb->expr()->in('s.eigenfunction', ':eigenfunctions'));
        $qb->setParameter('game', $game);
        $qb->setParameter('eigenfunctions', $eigenfunctions);
        $states = $qb->getQuery()->getResult();

        $resources = [
            'dogs'  => 0,
            'pigs'  => 0,
            'sheep' => 0,
        ];

        array_walk($states, function ($s) use (&$resources) {
            $resources['dogs'] += $s->dogs;
            $resources['pigs'] += $s->pigs;
            $resources['sheep'] += $s->sheep;
        });

        $conditionResolver = new ConditionResolver();

        array_walk($states,
            function ($s) use ($resources, $conditionResolver) {
                $s->triggered = $conditionResolver->resolve($s->eigenfunction->trigger, $resources);
                if ($s->triggered) {$s->closed = false;}
            }
        );

        $result = array_filter($states, function ($s) {return $s->triggered;});
        $opened = array_filter($states, function ($s) {return !$s->closed;});

        // if empty of player pieces

        // if (count($result) == 0) {
        //     array_walk($states,
        //         function ($s) use ($resources, $conditionResolver) {
        //             $s->setClosed(false);
        //         }
        //     );
        // } else {
        //     array_walk($states,
        //         function ($s) use ($resources, $conditionResolver) {
        //             $s->setClosed(true);
        //         }
        //     );
        //     array_walk($result,
        //         function ($s) use ($resources, $conditionResolver) {
        //             $s->setClosed(false);
        //         }
        //     );
        // }

        if (
            count($opened) == 1 &&
            (
                array_values($opened)[0]->prev->count() == 0 ||
                array_values($opened)[0]->prev->filter(
                    function ($s) use ($opened) {
                        // var_dump(array_values($opened)[0]->id . ":" . $s->id);
                        // var_dump([$s->triggered, $s->resolved, !$s->closed, ($s->triggered && $s->resolved && !$s->closed)]);
                        return $s->triggered && $s->resolved && !$s->closed;
                    })
                ->count() >= 1)
        ) {
            array_walk($states,
                function ($s) use ($resources, $conditionResolver) {
                    $s->setResolved(true);
                }
            );
        } else {
            array_walk($states,
                function ($s) use ($resources, $conditionResolver) {
                    $s->setResolved(false);
                }
            );
        }

        $this->em->flush();
        $result = array_map(
            function ($s) {
                return $s->eigenfunction->description;
            },
            $result
        );
        return $result;
    }
}
