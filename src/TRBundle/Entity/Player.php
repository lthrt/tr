<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\PlayerRepository")
 */
class Player
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /**
     * @var \TRBundle\Entity\Wave
     *
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="player")
     */
    private $game;

    /**
     * @var \TRBundle\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @var \TRBundle\Entity\Misson
     *
     * @ORM\ManyToOne(targetEntity="Mission")
     * @ORM\JoinColumn(name="mission_id", referencedColumnName="id")
     */
    private $mission;

    /**
     * @var integer
     *
     * @ORM\Column(name="sheep", type="integer", nullable=true)
     */
    private $sheep = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="dogs", type="integer", nullable=true)
     */
    private $dogs = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="pigs", type="integer", nullable=true)
     */
    private $pigs = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="current", type="boolean", nullable=true)
     */
    private $current = false;

    /**
     * @var \TRBundle\Entity\State
     *
     * @ORM\OneToOne(targetEntity="State", inversedBy="player")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /**
     * @var \TRBundle\Entity\Turn
     *
     * @ORM\OneToOne(targetEntity="Turn", mappedBy="player")
     */

    private $turn;

    public function __construct($name = null)
    {
        $this->name = $name;
    }
}
