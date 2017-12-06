<?php

namespace TRBundle\Repository;

use TRBundle\Entity\Game;

class StateRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByGame(Game $game)
    {
        $qb = $this->createQueryBuilder('s')
            ->join('s.eigenfunction', 'e')
            ->addOrderBy('e.id', 'DESC')
            ->addOrderBy('e.trigger', 'DESC');
        $qb->andWhere($qb->expr()->eq('s.game', ':game'))
            ->setParameter('game', $game->id);
        return $qb->getQuery()->getResult();
    }

    public function getPlayerLocations(Game $game)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->join('TRBundle:Player', 'p', 'WITH', $qb->expr()->eq('p.location', 's'));
        $qb->andWhere($qb->expr()->eq('s.game', ':game'))
            ->setParameter('game', $game->id);

        return $qb->getQuery()->getResult();
    }
}
