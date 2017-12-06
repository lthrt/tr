<?php

namespace TRBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use TRBundle\Entity\Player;
use TRBundle\Entity\State;

/**
 * State controller.
 *
 * @Route("state")
 */
class StateController extends Controller
{
    use FlashControllerTrait;

    /**
     * @Route("/{state}/adddog", name="state_add_dog")
     */
    public function addDogAction(
        Request $request,
        State   $state
    ) {
        // if ($this->getUser()->getPlayer()->location);
        $state->dogs += 1;
        $this->get('tr.wave_resolver')->resolveGame($state->game);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse($this->get('tr.game_data')->getGame($state->game));
    }

    /**
     * @Route("/{state}/addpig", name="state_add_pig")
     */
    public function addPigAction(
        Request $request,
        State   $state
    ) {
        // if ($this->getUser()->getPlayer()->location);
        $state->pigs += 1;
        $this->get('tr.wave_resolver')->resolveGame($state->game);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse($this->get('tr.game_data')->getGame($state->game));
    }

    /**
     * @Route("/{state}/addsheep", name="state_add_sheep")
     */
    public function addSheepAction(
        Request $request,
        State   $state
    ) {
        // if ($this->getUser()->getPlayer()->location);
        $state->sheep += 1;
        $this->get('tr.wave_resolver')->resolveGame($state->game);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse($this->get('tr.game_data')->getGame($state->game));
    }

    /**
     * @Route("/{state}/move/{player}", name="state_move_player")
     */
    public function movePlayerAction(
        Request $request,
        State   $state,
        Player  $player
    ) {
        $moveDenier = $this->get('tr.move_denier');
        $reason     = $moveDenier->reason($state, $player);
        if ($reason) {
            $this->warning($reason);
        } else {
            $player->state = $state;
            $this->get('tr.wave_resolver')->resolveGame($state->game);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->redirect($this->generateUrl('game_show', ['game' => $state->game->id]));
        return new JsonResponse($this->get('tr.game_data')->getGame($state->game));
    }
}
