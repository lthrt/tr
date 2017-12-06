<?php

namespace TRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * This is the model for the game, actual game spaces are 'State.php'
 *
 * @ORM\Table(name="eigenfunction")
 * @ORM\Entity(repositoryClass="TRBundle\Repository\EigenfunctionRepository")
 */
class Eigenfunction
{
    use \Lthrt\EntityBundle\Entity\DescriptionTrait;
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="trigger", type="string", length=255, nullable=true)
     */
    private $trigger;

    /**
     * @var string
     *
     * @ORM\Column(name="scoring", type="string", length=255, nullable=true)
     */
    private $scoring;

    /**
     * @var \TRBundle\Entity\Wave
     *
     * @ORM\ManyToOne(targetEntity="Wave", inversedBy="eigenfunction")
     */
    private $wave;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\ManyToMany(targetEntity="Eigenfunction", mappedBy="prev")
     */
    private $next;

    /**
     * @var \TRBundle\Entity\Eigenfunction
     *
     * @ORM\ManyToMany(targetEntity="Eigenfunction", inversedBy="next")
     * @ORM\JoinTable(name="eigenfunction__eigenfunction",
     *      joinColumns={@ORM\JoinColumn(name="next_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="prev_id", referencedColumnName="id")}
     * )
     */
    private $prev;

    public function __construct()
    {
        $this->next = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prev = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
