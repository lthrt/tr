<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * This is actual game spaces in play
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\RoundRepository")
 */
class Round
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var \TRBundle\Entity\Wave
     *
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="round")
     */
    private $game;

    /**
     * @var \TRBundle\Entity\Turn
     *
     * @ORM\OneToMany(targetEntity="Turn", mappedBy="round")
     */
    private $turn;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="complete", type="boolean")
     */
    private $complete = false;

    public function __construct(InitialRound $initialRound = null)
    {
        $this->turn = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
