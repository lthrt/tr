<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TRBundle\Entity\InitialState;

/**
 *
 * This is actual game spaces in play
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\TurnRepository")
 */
class Turn
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var \TRBundle\Entity\Round
     *
     * @ORM\ManyToOne(targetEntity="Round", inversedBy="turn")
     * @ORM\JoinColumn(name="round_id", referencedColumnName="id")
     */
    private $round;

    /**
     * @var \TRBundle\Entity\Player
     *
     * @ORM\OneToOne(targetEntity="Player", inversedBy="turn")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer")
     */
    private $order;

    /**
     * @var boolean
     *
     * @ORM\Column(name="complete", type="boolean")
     */
    private $complete = false;

    public function __construct(InitialState $initialState = null)
    {
        $this->next = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prev = new \Doctrine\Common\Collections\ArrayCollection();
        if ($initialState) {
            foreach (["pigs", "dogs", "sheep", "eigenfunction"] as $field) {
                $this->$field = $initialState->$field;
            }

            foreach (["triggered", "resolved", "closed"] as $field) {
                $this->$field = $initialState->$field;
            }
        }
    }

    public function setResources(array $resources = [])
    {
        $resources = array_merge(
            [
                'dogs'  => 0,
                'pigs'  => 0,
                'sheep' => 0,
            ],
            $resources
        );

        foreach ($resources as $key => $amount) {
            $this->$key = $amount;
        }
    }
}
