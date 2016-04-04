<?php
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;

class NotValidated
{
    protected $em;
    protected $nbSeries;
    protected $nbEpisodes;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
        $this->nbSeries = $this->getNbSerieNotValidated();
        $this->nbEpisodes = $this->getNbEpisodeNotValidated();
    }

    public function nbNotValidated()
    {
        return $this->nbSeries+$this->nbEpisodes;
    }

    public function nbSerieNotValidated()
    {

       return $this->nbSeries;
    }

    public function nbEpisodeNotValidated()
    {
        return $this->nbEpisodes;
    }

    public function getNbSerieNotValidated()
    {

        $notValidatedSerie = $this->em->getRepository('AppBundle:Serie')->countNotValidated();

        return $notValidatedSerie;
    }

    public function getNbEpisodeNotValidated()
    {

        $notValidatedEpisode = $this->em->getRepository('AppBundle:Episode')->countNotValidated();

        return $notValidatedEpisode;
    }
    
    public function getSerie(){
        return $this->em->getRepository('AppBundle:Serie')->getLastSerie(1,false);
    }

    public function getEpisode(){
        return $this->em->getRepository('AppBundle:Episode')->getLastepisode(1,false);
    }
}
