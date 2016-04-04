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
 * @Route("/moderation")
 */
class ValidationController extends Controller
{
    /**
     * @Route("/", name="moderation_index")
     */
    public function indexAction(Request $request)
    {

        return $this->render('admin/validation/layout.html.twig');
    }
}
