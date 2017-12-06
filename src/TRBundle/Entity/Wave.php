<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TRBundle\Repository\WaveRepository")
 */
class Wave
{
    use \Lthrt\EntityBundle\Entity\DescriptionTrait;
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\OneToMany(targetEntity="Eigenfunction", mappedBy="wave")
     */
    private $eigenfunction;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="align", type="integer", nullable=true)
     */
    private $align;
}
