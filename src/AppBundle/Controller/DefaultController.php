<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tchat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lastSeries = $em->getRepository('AppBundle:Serie')->getLastSerie();
        //TODO: Create a random search in Repo, only need poster & serie Id
        $randPoster = $em->getRepository('AppBundle:Serie')->getLastSerie(30);
        $lastEpisodes = $em->getRepository('AppBundle:Episode')->getLastepisode();
        $lastTchatMessages = $em->getRepository('AppBundle:Tchat')->getLast();
        $newMessage = new Tchat();
        $newTchatMessage = $this->createForm('AppBundle\Form\TchatType',$newMessage);

        return $this->render('wall/wall.html.twig',[
            'lastSeries' => $lastSeries,
            'lastEpisodes' => $lastEpisodes,
            'posters' =>$randPoster,
            'messages' => $lastTchatMessages,
            'form' => $newTchatMessage->createView()
        ]);
    }
}
