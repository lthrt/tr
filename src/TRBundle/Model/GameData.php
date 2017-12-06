<?php

namespace TRBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use TRBundle\Entity\Game;

class GameData
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getGame(Game $game)
    {
        // d3

        $data   = [];
        $states = $this->em->getRepository('TRBundle:State')->findByGame($game);

        $waves = [];
        foreach ($states as $state) {
            $wave['id']       = $state->eigenfunction->wave->id;
            $wave['name']     = $state->eigenfunction->wave->description;
            $wave['position'] = $state->eigenfunction->wave->position;
            $wave['align']    = $state->eigenfunction->wave->align;
            $targets          = [];
            foreach ($state->next as $next) {
                $targets[] = $next->id;
            }
            $waveStates[$state->eigenfunction->wave->id][] = [
                'eigenfunction_id' => $state->eigenfunction->id,
                'id'               => $state->id,
                'description'      => $state->eigenfunction->description,
                'wave'             => $state->eigenfunction->wave->id,
                'trigger'          => $state->eigenfunction->trigger,
                'scoring'          => $state->eigenfunction->scoring,
                'target'           => $targets,
                'pigs'             => $state->pigs,
                'dogs'             => $state->dogs,
                'sheep'            => $state->sheep,
                'triggered'        => $state->triggered,
                'resolved'         => $state->resolved,
                'closed'           => $state->closed,
            ];
            $waves[$state->eigenfunction->wave->id] = $wave;
        }

        foreach ($waves as $key => $wave) {
            $rank = -1;
            foreach ($waveStates[$wave['id']] as $k => $st) {
                $waveStates[$wave['id']][$k]['rank'] = ++$rank;
            }
            $waves[$key]['states'] = $waveStates[$wave['id']];
        }

        foreach ($waves as $key => $wave) {
            $data['waves'][] = $wave;
        }

        $data['title'] = $game->description;
        $data['game']  = $game->id;
        return $data;
    }

    public function getAdjacencyListForDistance(Game $game)
    {
        // d3

        $states = $this->em->getRepository('TRBundle:State')->findByGame($game, ['id' => 'ASC']);

        return $states;
    }
}
