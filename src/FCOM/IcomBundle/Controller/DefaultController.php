<?php

namespace FCOM\IcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FCOMIcomBundle:Default:index.html.twig');
    }
}
