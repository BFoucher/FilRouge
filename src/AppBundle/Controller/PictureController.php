<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Picture;

/**
 * Picture controller.
 *
 * @Route("/picture")
 */
class PictureController extends Controller
{
    /**
     * Lists all Picture entities.
     *
     * @Route("/", name="picture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pictures = $em->getRepository('AppBundle:Picture')->findAll();

        return $this->render('picture/index.html.twig', array(
            'pictures' => $pictures,
        ));
    }

    /**
     * Finds and displays a Picture entity.
     *
     * @Route("/{id}", name="picture_show")
     * @Method("GET")
     */
    public function showAction(Picture $picture)
    {

        return $this->render('picture/show.html.twig', array(
            'picture' => $picture,
        ));
    }
}
