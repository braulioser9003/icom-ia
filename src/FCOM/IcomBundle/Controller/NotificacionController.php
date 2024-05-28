<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\Notificacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NotificacionController extends Controller
{
    public function eliminarAction(Request $request, Notificacion $notificacion)
    {



        $em = $this->getDoctrine()->getManager();
        $em->remove($notificacion);
        $em->flush();

        return $this->redirectToRoute('fcom_icom_homepage');
    }
}
