<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Picture;
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
     * @Route("/", name="validation")
     */
    public function validateAction(Request $request)
    {
        $validator = $this->get('app.validator');

        if($validator->nbSerieNotValidated()){
            $serie = $validator->getSerie();
            return $this->render('admin/validation/serie.html.twig',[
                'serie'=>$serie[0]
            ]);

        }elseif ($validator->nbEpisodeNotValidated()){
            $episode = $validator->getEpisode();
            return $this->render('admin/validation/episode.html.twig',[
                'episode' => $episode[0]
            ]);

        }else{

            return $this->render('admin/validation/null.html.twig');
        }
    }

    /**
     * @Route("/validate/{type}/{id}/{validate}", name="validation_item")
     */
    public function validateSuccessAction(Request $request,$type,$id,$validate)
    {
        $em = $this->getDoctrine()->getManager();
        if ($type=== 'serie'){
            $serie = $em->getRepository('AppBundle:Serie')->find($id);
            if ($validate==='ok'){
                if ($serie->getParent()>0){
                    $oldSerie = $em->getRepository('AppBundle:Serie')->find($serie->getParent());
                    $oldSerie->setDescription($serie->getDescription());
                    $oldSerie->setName($serie->getName());
                    $oldSerie->setPicture(new Picture($serie->getPicture()));
                    $oldSerie->setAuthor($serie->getAuthor());
                    $oldSerie->setLanguage($serie->getLanguage());
                    $oldSerie->setThTvdbID($serie->getThTvdbID());
                    $em->remove($serie);
                    $em->persist($oldSerie);
                }else{
                    $serie->setValidated(true);
                    $em->persist($serie);
                }
            }else{
                $em->remove($serie);
            }
            $em->flush();

        }elseif ($type=== 'episode'){
            $episode = $em->getRepository('AppBundle:Episode')->find($id);
            if ($validate==='ok'){
                $episode->setValidated(true);
                $em->persist($episode);
            }else{
                $em->remove($episode);
            }
            $em->flush();

        }
        return $this->redirectToRoute('validation');
    }
}
