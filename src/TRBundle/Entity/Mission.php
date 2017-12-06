<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\MissionRepository")
 */
class Mission
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="lambs", type="integer", nullable=true)
     */
    private $lambs = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="puppies", type="integer", nullable=true)
     */
    private $puppies = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="piglets", type="integer", nullable=true)
     */
    private $piglets = 0;

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

    public function __construct($name = null)
    {
        $this->name = $name;
    }
}
