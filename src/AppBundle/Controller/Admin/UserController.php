<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @Route("/admin/users")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="admin_users_list")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/user/list.html.twig',[
            'users' => $users
        ]);
    }

    /**
     * @Route("/{user}", name="admin_users_edit")
     */
    public function editAction(Request $request,User $user)
    {
        return $this->render('admin/user/edit.html.twig',[
            'user' => $user
        ]);
    }

    /**
     * @Route("/{user}/ban", name="admin_users_ban")
     */
    public function banAction(Request $request,User $user)
    {
        $em = $this->getDoctrine()->getManager();
        if ($user->isEnabled()) {
            $user->setEnabled(0);
        }else{
            $user->setEnabled(1);
        }
        $em->persist($user);
        $em->flush();

        return $this->render('admin/user/edit.html.twig',[
            'user' => $user
        ]);
    }
}
