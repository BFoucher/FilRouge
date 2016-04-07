<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Serie;
use AppBundle\Form\SerieType;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
/**
 * Serie controller.
 *
 * @Route("/tvdb")
 */
class TvdbController extends Controller
{
    /**
     * Lists all Serie.
     *
     * @Route("/series/{name}", name="tvdb_search")
     * @Method("GET")
     */
    public function searchSerieAction($name)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $api = $this->container->get('thetvdb');
        $search = $api->searchTvShow($name,'fr');

        $jsonContent = $serializer->serialize($search, 'json');

        return new JsonResponse($jsonContent);
    }

}

?>