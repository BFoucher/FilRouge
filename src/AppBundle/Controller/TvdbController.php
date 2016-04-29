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
        $result = $api->searchTvShow($name,'fr');

        $jsonContent = $serializer->serialize($result, 'json');

        return new Response($jsonContent);
    }

    /**
     * Get Serie and All Episode by theTvId ID
     *
     * @Route("/series/{serieId}/all", name="tvdb_series_episodes")
     * @Method("GET")
     */
    public function getSerieAndEpisodesAction($serieId)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $api = $this->container->get('thetvdb');
        $result = $api->getTvShowAndEpisodes($serieId,'fr');

        $jsonContent = $serializer->serialize($result, 'json');

        return new Response($jsonContent);
    }

    /**
     * Get Serie  by theTvId ID
     *
     * @Route("/serie/{serieId}", name="tvdb_serie")
     * @Method("GET")
     */
    public function getSerieAction($serieId)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $api = $this->container->get('thetvdb');
        $result = $api->getTvShow($serieId,'fr');

        $jsonContent = $serializer->serialize($result, 'json');

        return new Response($jsonContent);
    }


}

?>