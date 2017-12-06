<?php

namespace TRBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TRBundle\Entity\Game;

/**
 * Game controller.
 *
 * @Route("game")
 */
class GameController extends Controller
{
    /**
     * @Route("/board", name="game_board")
     */
    public function boardAction(Request $request)
    {
        $game = $this->getDoctrine()->getManager()
            ->getRepository('TRBundle:Game')
            ->findOneByDescription('TestData');
        return new Response($this->container->get('templating')
                ->render('board/board.html.twig',
                    [
                        'data' => $this->get('tr.game_data')->getGame($game),
                    ]
                )
        );
    }

    /**
     * @Route("/{game}/data", name="game_data", requirements={"game" = "\d+"})
     */
    public function dataAction(
        Request $request,
        Game    $game
    ) {
        return new JsonResponse($this->get('tr.game_data')->getGame($game));
    }

    /**
     * Creates a new game entity.
     *
     * @Route("/", name="game_list")
     * @Method({"GET", "POST"})
     */
    public function listAction(Request $request)
    {
        $games = $this->getDoctrine()->getManager()->getRepository('TRBundle:Game')->findAll();
        return $this->render('game/list.html.twig',
            [
                'games' => $games,
            ]
        );
    }

    /**
     * Creates a new game entity.
     *
     * @Route("/new", name="game_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm('TRBundle\Form\NewGameType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $this->get('tr.game_maker')->newGame($form->get('name')->getData());

            return $this->redirectToRoute('game_show', ['game' => $game]);
        }

        return $this->render('game/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{game}/show", name="game_show", requirements={"game" = "\d+"})
     */
    public function showAction(
        Request $request,
        Game    $game
    ) {
        return new Response($this->container->get('templating')
                ->render('board/game.html.twig',
                    [
                        'game' => $game->id,
                    ]
                )
        );
    }
}
