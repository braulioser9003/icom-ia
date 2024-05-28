<?php

namespace FCOM\IcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrincipalController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $noticias = $em->getRepository('FCOMIcomBundle:Noticias')->findAll();

        return $this->render('FCOMIcomBundle:Default:index.html.twig', array(
            'noticias' => '$noticias'
        ));

    }
    public function headerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $dql_n ="SELECT n FROM FCOMIcomBundle:Notificacion n";
        $notificacion= $em->createQuery($dql_n)->getResult();

        return $this->render('plantillas/Backend/backendHeaded.html.twig', array(
            'notificacion' => $notificacion,
            'user' => $user,
        ));
    }
    public function wirzadAction()
    {
        return $this->render('FCOMIcomBundle::wirzad.html.twig');
    }
    public function wirzadMetronicAction()
    {
        return $this->render('@FCOMIcom/form_wizard_metronic.html.twig');
    }
}

