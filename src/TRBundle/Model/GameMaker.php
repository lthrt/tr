<?php

namespace TRBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use TRBundle\Entity\Game;
use TRBundle\Entity\State;

class GameMaker
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function newGame($title)
    {
        $game           = new Game($title);
        $eigenfunctions = $this->em->getRepository('TRBundle:Eigenfunction')->findBy([], ['id' => 'ASC']);
        $initialStates  = $this->em->getRepository('TRBundle:InitialState')->initial();
        array_walk($eigenfunctions, function ($eigenfunction) use ($game, $initialStates) {
            $state = (
                isset($initialStates[$eigenfunction->getId()]) ?
                new State($initialStates[$eigenfunction->getId()]) :
                new State()
            );
            $state->eigenfunction = $eigenfunction;
            $state->game          = $game;
            $this->em->persist($state);
        });
        $this->em->persist($game);
        $this->em->flush();

        $states = $this->em->getRepository('TRBundle:State')->findByGame($game);

        array_walk($states, function ($state) use ($game, $states) {
            $prev = array_filter($states,
                function ($s) use ($state) {
                    return $state->eigenfunction->prev && $state->eigenfunction->prev->contains($s->eigenfunction);
                });
            array_walk($prev, function ($p) use ($state) {return $state->addPrev($p);});
        });

        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }
}
