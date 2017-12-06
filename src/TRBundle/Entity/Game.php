<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\GameRepository")
 */
class Game
{
    use \Lthrt\EntityBundle\Entity\DescriptionTrait;
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var \TRBundle\Entity\Player
     *
     * @ORM\OneToMany(targetEntity="Player", mappedBy="game")
     */
    private $player;

    /**
     * @var \TRBundle\Entity\State
     *
     * @ORM\OneToMany(targetEntity="State", mappedBy="game")
     */
    private $state;

    /**
     * @var \TRBundle\Entity\Round
     *
     * @ORM\OneToMany(targetEntity="Round", mappedBy="game")
     */
    private $round;

    public function __construct($description = null)
    {
        $this->description = $description;
        $this->player      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->state       = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get description
     *
     * @return
     */

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
