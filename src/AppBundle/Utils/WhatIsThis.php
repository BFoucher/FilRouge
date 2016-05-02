<?php
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;

class WhatIsThis
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function getThisSerie($id){
        $serie = $this->em->getRepository('AppBundle:Serie')->find($id);
        return $serie;
    }
}
