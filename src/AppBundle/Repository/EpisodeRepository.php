<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EpisodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EpisodeRepository extends EntityRepository
{
    public function countNotValidated(){
        $query = $this->createQueryBuilder('episode')
            ->select('COUNT(episode)')
            ->where('episode.validated = false')
            ->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getAll(){
        $query = $this->createQueryBuilder('episode')
            ->select('episode')
            ->orderBy('episode.name','ASC')
            ->where('episode.validated=:is_validated')
            ->setParameter(':is_validated',true)
            ->getQuery();


        return $query->getResult();
    }

    public function getOne($episodeId){
        $query = $this->createQueryBuilder('episode')
            ->select('episode')
            ->where('episode.id = :id')
            ->andWhere('episode.validated= :is_validated')
            ->setParameter('id', $episodeId)
            ->setParameter(':is_validated',true)
            ->getQuery();

        return $query->getResult();
    }


    public function getLastepisode($nb = 5,$validate = true){
        $query = $this->createQueryBuilder('episode')
            ->select('episode')
            ->orderBy('episode.id', 'DESC')
            ->andWhere('episode.validated= :is_validated')
            ->setParameter(':is_validated',$validate)
            ->setMaxResults($nb)
            ->getQuery();

        return $query->getResult();
    }


}
