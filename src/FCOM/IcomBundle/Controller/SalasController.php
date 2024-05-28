<?php

namespace FCOM\IcomBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use FCOM\IcomBundle\Entity\Dia;
use FCOM\IcomBundle\Entity\intervalo;
use FCOM\IcomBundle\Entity\Salas;
use Proxies\__CG__\FCOM\IcomBundle\Entity\Duracion;
use Proxies\__CG__\FCOM\IcomBundle\Entity\Tematica;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Time;

/**
 * Sala controller.
 *
 */
class SalasController extends Controller
{
    /**
     * Lists all sala entities.
     *
     */
    public function indexAction(Request $request)
    {
        $salas = new Salas();
        $salas_nueva = new Salas();
        $duracion = new Duracion();
        $form_sala = $this->createForm('FCOM\IcomBundle\Form\SalasType', $salas_nueva, array('method' => 'POST'));
        $form_sala->handleRequest($request);

        $form_sala_edit = $this->createForm('FCOM\IcomBundle\Form\SalasType');
        $form_sala_edit->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $dql_s ="SELECT s FROM FCOMIcomBundle:Salas s";
        $salas= $em->createQuery($dql_s)->getResult();

        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();

        $dql_u ="SELECT u FROM FCOMIcomBundle:Duracion u";
        $duracion= $em->createQuery($dql_u)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p WHERE p.asignado = 0";
        $ponencias= $em->createQuery($dql_p)->getResult();

        $dql_i ="SELECT i FROM FCOMIcomBundle:intervalo i";
        $intervalo= $em->createQuery($dql_i)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematica= $em->createQuery($dql_t)->getResult();
        $respuesta = $request->get('respuesta');








        if($request->get('records') != ""){
            $records = $request->get('records');
        }
        if($request->get('records') == ""){
            $records = 10;
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $salas,
            $request->query->getInt('page', 1),
            $records
        );
        if ($form_sala->isSubmitted() && $form_sala->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $duracion = $request->get('duracion');
            $asignacion = $request->get('asignacion');

            $horaInicioActual = $form_sala->get('horaInicio')->getData();

            $update = $em->getRepository('FCOMIcomBundle:Duracion')->find($duracion);
            $salas_nueva->setDuracion($update);
            $salas_nueva->setAsignado($asignacion);
            $salas_nueva->setHoraInicioActual($horaInicioActual);
            $salas_nueva->setCantidadActPonencias(0);
            $em->persist($salas_nueva);
            $em->flush();

            $form_nuevo = $this->createForm('FCOM\IcomBundle\Form\SalasType', $salas_nueva, array('method' => 'POST'));
            $form_nuevo->handleRequest($request);

            return $this->redirectToRoute('salas_index', array(
                'salas', array(
                    'id' => $salas_nueva->getId(),
                    'dias' => $dia,
                ),


            ));
        }




        if($request->get('respuesta') != ""){
            $intervalo = $em->getRepository('FCOMIcomBundle:intervalo')->findAll();
            foreach($intervalo as $inter){
                if($inter->getPosicion() == 0){
                    foreach($inter->getPonencias() as $ponencias ){
                        $ponencias->setAsignado(0);
                    }
                    $em->remove($inter);
                }
            }
            $em->flush();
            $respuesta = $request->get('respuesta');

            return $this->render('@FCOMIcom/salas/admin/index.html.twig', array(
                'pagination' => $pagination,
                'form_sala' =>$form_sala->createView(),
                'form_sala_edit' =>$form_sala_edit->createView(),
                'dias' => $dia,
                'respuesta' => $respuesta,
                'duracion' => $duracion,
                'ponencias' => $ponencias,
                'intervalo' => $intervalo,
                'tematica' => $tematica,
            ));


        }







        return $this->render('@FCOMIcom/salas/admin/index.html.twig', array(
            'pagination' => $pagination,
            'form_sala' =>$form_sala->createView(),
            'form_sala_edit' =>$form_sala_edit->createView(),
            'dias' => $dia,
            'respuesta' => $respuesta,
            'duracion' => $duracion,
            'ponencias' => $ponencias,
            'intervalo' => $intervalo,
            'tematica' => $tematica,
        ));
    }

    /**
     * Creates a new sala entity.
     *
     */
    public function nuevaAction(Request $request)
    {
        $sala = new Salas();
        $form = $this->createForm('FCOM\IcomBundle\Form\SalasType', $sala);
        $form->handleRequest($request);



        return $this->render('@FCOMIcom/salas/nueva.html.twig', array(
            'sala' => $sala,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sala entity.
     *
     */
    public function mostrarAction(Salas $sala)
    {
        $deleteForm = $this->createDeleteForm($sala);

        return $this->render('@FCOMIcom/salas/mostrar.html.twig', array(
            'sala' => $sala,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sala entity.
     *
     */
    public function editarAction(Request $request, Salas $sala)
    {
        $em = $this->getDoctrine()->getManager();

        $dia = $em->getRepository('FCOMIcomBundle:Dia')->find($request->get('dia'));
        $sala->setNombre($request->get('nombre'));
        $sala->setDia($dia);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('salas_index');

    }



    /**
     * Deletes a sala entity.
     *
     */
    public function eliminarAction(Request $request, Salas $sala)
    {

        $em = $this->getDoctrine()->getManager();
        if($sala->getIntervalo()->count() != 0){
            foreach( $sala->getIntervalo() as $inter){
                foreach($inter->getPonencias() as $ponencias){
                    $ponencias->setAsignado(0);

                }
                $em->remove($inter);
                $sala->removeIntervalo($inter);
            }
        }
        $em->remove($sala);
        $em->flush();


        return $this->redirectToRoute('salas_index');
    }

    public function programaPonenciasAction(Request $request)
    {

        $sala = new Salas();

        $dia = new Dia();
        $intervalo = new intervalo();



        $em = $this->getDoctrine()->getManager();
        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();

        $dql_i ="SELECT i FROM FCOMIcomBundle:intervalo i";
        $intervalo= $em->createQuery($dql_i)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematicas= $em->createQuery($dql_t)->getResult();

        $dql_s ="SELECT s FROM FCOMIcomBundle:Salas s";
        $sala= $em->createQuery($dql_s)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p WHERE p.asignado = 0";
        $ponencias= $em->createQuery($dql_p)->getResult();

        $respuesta = $request->get('respuesta');

        return $this->render('@FCOMIcom/salas/admin/programaPonencia.html.twig', array(
            'sala' => $sala,
            'dia' => $dia,
            'intervalo' => $intervalo,
            'respuesta' => $respuesta,
            'tematicas' => $tematicas,
            'ponencias' => $ponencias,


        ));
    }
    public function programaPosterAction(Request $request)
    {

        $sala = new Salas();

        $dia = new Dia();
        $intervalo = new intervalo();

        $em = $this->getDoctrine()->getManager();
        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();

        $dql_i ="SELECT i FROM FCOMIcomBundle:intervalo i";
        $intervalo= $em->createQuery($dql_i)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p";
        $ponencias= $em->createQuery($dql_p)->getResult();

        $dql_s ="SELECT s FROM FCOMIcomBundle:Salas s";
        $sala= $em->createQuery($dql_s)->getResult();


        $respuesta = $request->get('respuesta');

        return $this->render('@FCOMIcom/salas/admin/programaPoster.html.twig', array(
            'sala' => $sala,
            'dia' => $dia,
            'intervalo' => $intervalo,
            'respuesta' => $respuesta,
            'ponencias' => $ponencias,

        ));
    }

    public function actualizarAction(Request $request, Salas $salas)
    {


        $em = $this->getDoctrine()->getManager();
        $sala = $em->getRepository('FCOMIcomBundle:Salas')->findAll();
        $intervalo = $em->getRepository('FCOMIcomBundle:intervalo')->findAll();


        foreach( $sala as $sa){
            if($sa->getId() != $salas->getId()){
                $sa->setAsignado(1);
                $em->persist($sa);

            }
            if($sa->getId() == $salas->getId()){
                $sa->setAsignado(0);
                $em->persist($sa);
            }
        }

        foreach($intervalo as $inter){
            if($inter->getPosicion() == 0){
                $inter->setPosicion(1);
                $em->persist($inter);
            }
        }
        $tematica = new Tematica();

        foreach($salas->getIntervalo() as $inter){
            $salas->removeIntervalo($inter);
            if($inter->getPosicion() == 0){
                foreach($inter->getPonencia() as $ponencia){


                }
                $tematica->addIntervalo($inter);
                $em->persist($tematica);
            }
            $inter->setPosicion(0);
            $em->persist($inter);
        }
        $em->persist($salas);

        $em->flush();
        return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=CrearIntervalo');

    }

    public function crearProgramaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $intervalo = $em->getRepository('FCOMIcomBundle:intervalo')->findAll();
        $ponencias = $em->getRepository('FCOMIcomBundle:Ponencias')->findAll();
        $salas = $em->getRepository('FCOMIcomBundle:Salas')->findAll();

        foreach($intervalo as $inter){
            $em->remove($inter);
        }
        foreach($ponencias as $ponencia){
            $ponencia->setAsignado(0);
            $em->persist($ponencia);
        }
        foreach($salas as $sala){
            $sala->setAsignado(0);
            $salInicio = $sala->getHoraInicio();
            $sala->setHoraInicioActual($salInicio);
            $em->persist($sala);
        }
        $em->flush();
        return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=IniciarSMA');
    }

    public function eliminarIntervaloAction(Request $request, intervalo $intervalo, Salas $salas)
    {


        $em = $this->getDoctrine()->getManager();
        if($salas->getIntervalo()->count() == 1){

            $eliminar = $em->getRepository('FCOMIcomBundle:intervalo')->find($salas->getIntervalo()->get(0)->getId());
            $salas->setHoraInicioActual($salas->getHoraInicio());
            for($i = 0; $i < $intervalo->getPonencias()->count(); $i++){
                $intervalo->getPonencias()->get($i)->setAsignado(0);
            }
            $em->persist($intervalo);
            $salas->setAsignado(0);
            $em->persist($salas);
            $em->remove($eliminar);
            $em->flush();
        }

        if(($salas->getIntervalo()->count() == 2) && ($salas->getIntervalo()->get(0)->getId() == $intervalo->getId())) {
            $eliminar = $em->getRepository('FCOMIcomBundle:intervalo')->find($salas->getIntervalo()->get(0)->getId());
            $salas->setHoraInicioActual($salas->getIntervalo()->get(0)->getHoraInicio());
            $salas->getIntervalo()->get(1)->setPosicion(0);
            $prueba = $salas->getIntervalo()->get(1);
            $salas->removeIntervalo($prueba);
            $salas->setAsignado(0);
            for($i = 0; $i < $intervalo->getPonencias()->count(); $i++){
                $intervalo->getPonencias()->get($i)->setAsignado(0);
            }
            $em->persist($intervalo);
            $em->persist($salas);
            $em->remove($eliminar);
            $em->flush();
            return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=EliminarIntervalo');
        }
        if(($salas->getIntervalo()->count() == 2) && ($salas->getIntervalo()->get(1)->getId() == $intervalo->getId())){
            $eliminar = $em->getRepository('FCOMIcomBundle:intervalo')->find($intervalo);
            $salas->setHoraInicioActual($salas->getIntervalo()->get(0)->getHoraFinal());
            $salas->setAsignado(0);
            for($i = 0; $i < $intervalo->getPonencias()->count(); $i++){
                $intervalo->getPonencias()->get($i)->setAsignado(0);
            }
            $em->persist($intervalo);
            $em->persist($salas);
            $em->remove($eliminar);
            $em->flush();
        }
        if(($salas->getIntervalo()->count() == 3) && ($salas->getIntervalo()->get(0)->getId() == $intervalo->getId())) {
            $eliminar = $em->getRepository('FCOMIcomBundle:intervalo')->find($salas->getIntervalo()->get(0)->getId());
            $salas->setHoraInicioActual($salas->getIntervalo()->get(0)->getHoraInicio());
            $salas->getIntervalo()->get(1)->setPosicion(0);
            $salas->getIntervalo()->get(2)->setPosicion(0);
            $prueba1 = $salas->getIntervalo()->get(1);
            $prueba2 = $salas->getIntervalo()->get(2);
            $salas->removeIntervalo($prueba1);
            $salas->removeIntervalo($prueba2);
            for($i = 0; $i < $intervalo->getPonencias()->count(); $i++){
                $intervalo->getPonencias()->get($i)->setAsignado(0);
            }
            $em->persist($intervalo);
            $salas->setAsignado(0);
            $em->persist($salas);
            $em->remove($eliminar);
            $em->flush();
            return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=EliminarIntervalo');
        }
        if(($salas->getIntervalo()->count() == 3) && ($salas->getIntervalo()->get(1)->getId() == $intervalo->getId())) {
            $eliminar = $em->getRepository('FCOMIcomBundle:intervalo')->find($salas->getIntervalo()->get(1)->getId());
            $salas->setHoraInicioActual($salas->getIntervalo()->get(0)->getHoraInicio());
            $salas->getIntervalo()->get(0)->setPosicion(0);
            $salas->getIntervalo()->get(2)->setPosicion(0);
            $prueba1 = $salas->getIntervalo()->get(0);
            $prueba2 = $salas->getIntervalo()->get(2);
            $salas->removeIntervalo($prueba1);
            $salas->removeIntervalo($prueba2);
            for($i = 0; $i < $intervalo->getPonencias()->count(); $i++){
                $intervalo->getPonencias()->get($i)->setAsignado(0);
            }
            $em->persist($intervalo);
            $salas->setAsignado(0);
            $em->persist($salas);
            $em->remove($eliminar);
            $em->flush();
            return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=EliminarIntervalo');
        }
        if(($salas->getIntervalo()->count() == 3) && ($salas->getIntervalo()->get(2)->getId() == $intervalo->getId())) {
            $eliminar = $em->getRepository('FCOMIcomBundle:intervalo')->find($salas->getIntervalo()->get(2)->getId());
            $salas->setHoraInicioActual($salas->getIntervalo()->get(0)->getHoraInicio());
            $salas->getIntervalo()->get(0)->setPosicion(0);
            $salas->getIntervalo()->get(1)->setPosicion(0);
            $prueba1 = $salas->getIntervalo()->get(0);
            $prueba2 = $salas->getIntervalo()->get(1);
            $salas->removeIntervalo($prueba1);
            $salas->removeIntervalo($prueba2);
            for($i = 0; $i < $intervalo->getPonencias()->count(); $i++){
                $intervalo->getPonencias()->get($i)->setAsignado(0);
            }
            $em->persist($intervalo);
            $salas->setAsignado(0);
            $em->persist($salas);
            $em->remove($eliminar);
            $em->flush();
            return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=EliminarIntervalo');
        }
        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();

        $dql_i ="SELECT i FROM FCOMIcomBundle:intervalo i";
        $intervalos= $em->createQuery($dql_i)->getResult();

        $dql_s ="SELECT s FROM FCOMIcomBundle:Salas s";
        $sala= $em->createQuery($dql_s)->getResult();

        return $this->redirectToRoute('salas_programa_ponencias');
    }




    /**
     * Creates a form to delete a sala entity.
     *
     * @param Salas $sala The sala entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salas $sala)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salas_eliminar', array('id' => $sala->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
