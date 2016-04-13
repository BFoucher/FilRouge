<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Search controller.
 *
 */
class SearchController extends Controller
{
    /**
     * Search
     *
     * @Route("/search", name="search")
     * @Method("POST")
     */
    public function searchAction(){
        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('AppBundle:Serie')->searchLike('robot');
        return $this->render(':search:result_search.html.twig',[
            'series'=>$series
        ]);
    }
}