<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->getLastUsers(3);
        $series = $em->getRepository('AppBundle:Serie')->findAll(); //TODO: create getLastSeries() query
        $episodes = $em->getRepository('AppBundle:Episode')->findAll(); //TODO: create getLastEpisodes() query
        return $this->render('admin/default/index.html.twig',[
            'users' => $users,
            'series' => $series,
            'episodes' => $episodes
        ]);
    }
}
