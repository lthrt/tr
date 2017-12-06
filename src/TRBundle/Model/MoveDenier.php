<?php

namespace TRBundle\Model;

use Doctrine\ORM\EntityManagerInterface;
use TRBundle\Entity\Player;
use TRBundle\Entity\State;

class MoveDenier
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function reason(
        State  $state,
        Player $player
    ) {
        return "Feature not implemented";
    }
}
