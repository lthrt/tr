<?php

namespace TRBundle\Repository;

class InitialStateRepository extends \Doctrine\ORM\EntityRepository
{
    public function initial()
    {
        $states = $this->createQueryBuilder('i')->getQuery()->getResult();
        foreach ($states as $state) {
            $initialStates[$state->eigenfunction->id] = $state;
        }
        return $initialStates;
    }
}
