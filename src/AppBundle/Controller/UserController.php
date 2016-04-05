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

}