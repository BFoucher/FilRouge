<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\AdminUserType;

/**
 * Class DefaultController
 * @Route("/admin/users")
 * @Security("has_role('ROLE_MODERATOR')")
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
     * @Route("/{user}/ban", name="admin_users_ban")
     * @Security("has_role('ROLE_MODERATOR')")
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

        return $this->redirectToRoute('user_profile',['user'=>($user->getId())]);
    }
    /**
     * @Route("/{user}", name="admin_users_edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request,User $user)
    {
        $form = $this->createForm('AppBundle\Form\AdminUserType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin_users_list');
        }
        return $this->render('admin/user/edit.html.twig',[
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


}
