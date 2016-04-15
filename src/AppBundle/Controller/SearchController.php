<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

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
    public function searchAction(Request $request){
        $searchRequest = $request->get('search');
        //$searchRequest = str_replace(' ','%',$searchRequest);
        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('AppBundle:Serie')->searchLike($searchRequest,20);
        $episodes = $em->getRepository('AppBundle:Episode')->searchLike($searchRequest,20);
        $users = $em->getRepository('AppBundle:User')->searchLike($searchRequest);
        return $this->render(':search:result_search.html.twig',[
            'search' => $searchRequest,
            'series'=>$series,
            'episodes'=>$episodes,
            'users'=>$users
        ]);
    }
}