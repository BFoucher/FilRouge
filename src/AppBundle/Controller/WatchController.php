<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use AppBundle\Entity\User;
use AppBundle\Entity\Episode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Watch controller.
 *
 */
class WatchController extends Controller
{
    /**
     * Watch or UnWatch an episode.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/episode/{episode}/watch", name="episode_watch")
     * @Method("GET")
     */
    public function watchAction(Episode $episode){
        $em = $this->getDoctrine()->getManager();
        //On récupère l'utilisateur courant
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //On vérifie si la série est présente dans les séries suivies
        if (!$user->getWatch()->contains($episode)){
            //Si non présent on l'ajoute
            $user->addWatch($episode);

        }else{
            //Sinon on le supprime
            $user->removeWatch($episode);
        }
        //On persist en BDD
        $em->persist($user);
        $em->flush();
        //on renvoie l'user sur la page de la série
        return $this->redirectToRoute('serie_show',['serieId'=>$episode->getSerie()->getId()]);
    }
}