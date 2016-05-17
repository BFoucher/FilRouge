<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Episode;
use AppBundle\Form\EpisodeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Episode controller.
 *
 * 
 * @Route("/episode")
 */
class EpisodeController extends Controller
{

    /**
     * Creates a new Episode entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/{serie}/new", name="episode_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Serie $serie)
    {
        $episode = new Episode();
        $form = $this->createForm('AppBundle\Form\EpisodeType', $episode);
        $form->handleRequest($request);

        $episode->setSerie($serie);
        $episode->setAuthor($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($episode);
            $em->flush();

            return $this->redirectToRoute('serie_show', array('serieId' => $episode->getSerie()->getId()));
        }

        return $this->render('episode/new.html.twig', array(
            'episode' => $episode,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Episode entity.
     *
     * @Route("/{id}/edit", name="episode_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Episode $episode)
    {
        $deleteForm = $this->createDeleteForm($episode);
        $editForm = $this->createForm('AppBundle\Form\EpisodeType', $episode);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //Create a new episode with parent ref
            $newEpisode = clone $episode;
            $newEpisode->setParent($episode->getId());
            $newEpisode->setValidated(0);
            $newEpisode->setAuthor($this->getUser());

            //Persist only NewEpisode for validation
            $em->detach($episode);
            $em->persist($newEpisode);
            $em->flush();
            $this->addFlash('notice', 'La modification à bien été enregistrée, en attente de validation par un modérateur' );

            return $this->redirectToRoute('episode_edit', array('id' => $episode->getId()));
        }

        return $this->render('episode/edit.html.twig', array(
            'episode' => $episode,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Episode entity.
     * @Security("has_role('ROLE_MODERATOR')")
     *
     * @Route("/{id}", name="episode_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Episode $episode)
    {
        $form = $this->createDeleteForm($episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($episode);
            $em->flush();
        }

        return $this->redirectToRoute('serie_index');
    }

    /**
     * Creates a form to delete a Episode entity.
     *
     * @param Episode $episode The Episode entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Episode $episode)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('episode_delete', array('id' => $episode->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
