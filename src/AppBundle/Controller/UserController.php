<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * List User.
     *
     * @Route("/", name="user_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->getAll();
        return $this->render('user/list.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Show Profile.
     *
     * @Route("/{user}", name="user_profile")
     * @Method("GET")
     */
    public function showProfileAction(User $user)
    {
        return $this->render('user/profile.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Show My Follows Series.
     *
     * @Route("/{user}/follows", name="user_follows")
     * @Method("GET")
     */
    public function showFollowsSeriesAction($user)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->getUserWithFollowsSeries($user);
        return $this->render('user/follows.html.twig', array(
            'user' => $user
        ));
    }

}