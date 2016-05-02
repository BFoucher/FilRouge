<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Follow controller.
 *
 */
class FollowController extends Controller
{
    /**
     * Follow or Unfollow a serie.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/serie/{serie}/follow", name="serie_follow")
     * @Method("GET")
     */
    public function followAction(Serie $serie){
        $em = $this->getDoctrine()->getManager();
        //On récupère l'utilisateur courant
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //On vérifie si la série est présente dans les séries suivies
        if (!$user->getFollow()->contains($serie)){
            //Si non présent on l'ajoute
            $user->addFollow($serie);

        }else{
            //Sinon on le supprime
            $user->removeFollow($serie);
        }
        //On persist en BDD
        $em->persist($user);
        $em->flush();
        //on renvoie l'user sur la page de la série
        return $this->redirectToRoute('serie_show',['serieId'=>$serie->getId()]);
    }
}