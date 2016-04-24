<?php
namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use Symfony\Component\BrowserKit\Request;

class Tchat
{
    protected $em ;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function getLastMessages($nb = 10){
        $messages = $this->em->getRepository('AppBundle:Tchat')->getLast($nb);
        return $messages;
    }

    public function newMessage(Request $request){
        $message = new Tchat();
        $form = $this->createForm('AppBundle\Form\TchatType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serie);
            $em->flush();

            return $this->redirectToRoute('serie_show', array('id' => $serie->getId()));
        }

        return $this->render('serie/new.html.twig', array(
            'serie' => $serie,
            'form' => $form->createView(),
        ));
    }
}