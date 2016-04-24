<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tchat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Snc\RedisBundle\Client\Predis;

/**
 * Tchat controller.
 *
 */
class TchatController extends Controller
{
    /**
     * Show Tchat
     * @Route("/tchat", name="tchat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('AppBundle:Tchat')->getLast();
        $message = new Tchat();
        $form = $this->createForm('AppBundle\Form\TchatType',$message);

        return $this->render(':tchat:index.html.twig', array(
            'messages'=>$messages,
            'form' => $form->createView()
        ));

    }


    /**
     * Post a Message
     *
     * @Route("/tchat", name="tchat_post")
     * @Method("POST")
     */
    public function newMessageAction(Request $request){
        if($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            $user = $this->getUser();
        }else{
            return new JsonResponse(array('error'=>'Forbidden'));
        }
        $message = new Tchat();
        $message->setDate(new \DateTime());
        $message->setAuthor($user);

        $form = $this->createForm('AppBundle\Form\TchatType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $redis = $this->container->get('snc_redis.default');
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            $responseMessage = array(
                'date' => $message->getDate()->format('d/m h:i'),
                'message' => $message->getMessage(),
                'author' => array(
                    'username' => $user->getUsername(),
                    'avatar' => $user->getAvatar())
            );

            //Todo: serialiser l'object message avance de l'envoyer à Redis...
            $response = new JsonResponse();
            $response->setData($responseMessage);

            $redis->publish('notification',$response->getContent());
            return $response;
        }

        $response = new JsonResponse();
        $response->setData(array('error'=>'bad request'));
        return $response;
    }
}