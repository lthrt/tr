<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TRBundle\Entity\InitialState;

/**
 *
 * This is actual game spaces in play
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\StateRepository")
 */
class State
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var \TRBundle\Entity\Wave
     *
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="state")
     */
    private $game;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\ManyToOne(targetEntity="Eigenfunction")
     */
    private $eigenfunction;

    /**
     * @var integer
     *
     * @ORM\Column(name="sheep", type="integer")
     */
    private $sheep = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="dogs", type="integer")
     */
    private $dogs = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="pigs", type="integer")
     */
    private $pigs = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resolved", type="boolean")
     */
    private $resolved = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="closed", type="boolean")
     */
    private $closed = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="triggered", type="boolean")
     */
    private $triggered = false;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\ManyToMany(targetEntity="State", mappedBy="prev")
     */
    private $next;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\ManyToMany(targetEntity="State", inversedBy="next")
     * @ORM\JoinTable(name="state__state",
     *      joinColumns={@ORM\JoinColumn(name="next_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="prev_id", referencedColumnName="id")}
     * )
     */
    private $prev;

    /**
     * @var \TRBundle\Entity\Player
     *
     * @ORM\OneToOne(targetEntity="Player", mappedBy="state")
     */

    private $player;

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
