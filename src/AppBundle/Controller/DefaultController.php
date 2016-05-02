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
        $randPoster = $em->getRepository('AppBundle:Serie')->getLastSerie(30);
        shuffle($randPoster);
        $lastComments = $em->getRepository('AppBundle:Comment')->getLastComments();
        $lastTchatMessages = $em->getRepository('AppBundle:Tchat')->getLast();
        $newMessage = new Tchat();
        $newTchatMessage = $this->createForm('AppBundle\Form\TchatType',$newMessage);
        dump($lastComments);
        return $this->render('wall/wall.html.twig',[
            'lastSeries' => $lastSeries,
            'posters' =>$randPoster,
            'lastComments' => $lastComments,
            'messages' => $lastTchatMessages,
            'form' => $newTchatMessage->createView()
        ]);
    }
}
