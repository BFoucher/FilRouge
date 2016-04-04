<?php
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;

class NotValidated
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function nbNotValidated()
    {

        $notValidatedSerie = $this->em->getRepository('AppBundle:Serie')->countNotValidated();

        return $notValidatedSerie;
    }
}
