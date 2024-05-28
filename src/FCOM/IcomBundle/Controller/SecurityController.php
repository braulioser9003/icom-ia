<?php

namespace FCOM\IcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    public function loginAction(){
        $authenticacion = $this->get('security.authentication_utils');
        $error = $authenticacion->getLastAuthenticationError();
        $lastUsername = $authenticacion->getLastUsername();

        return $this->render('FCOMIcomBundle:security:login.html.twig', array(
            'ultimoUsuario' => $lastUsername,
            'error' => $error,
        ));
    }
    public function loginCheckAction(){

    }

}
