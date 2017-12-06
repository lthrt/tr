<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\InitialStateRepository")
 */
class InitialState
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\ManyToOne(targetEntity="Eigenfunction")
     */
    private $eigenfunction;

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
     * @ORM\Column(name="resolved", type="boolean", nullable=true)
     */
    private $resolved = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="closed", type="boolean", nullable=true)
     */
    private $closed = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="triggered", type="boolean", nullable=true)
     */
    private $triggered = true;

    public function __construct() {}
}
