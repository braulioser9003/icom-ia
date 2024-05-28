<?php

namespace FCOM\IcomBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FCOM\IcomBundle\Entity\intervalo;
use FCOM\IcomBundle\Entity\Ponencias;
use FCOM\IcomBundle\Entity\Salas;
use FCOM\IcomBundle\Entity\Tematica;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Intervalo controller.
 *
 */
class intervaloController extends Controller
{
    /**
     * Lists all intervalo entities.
     *
     */
    public function indexAction(Request $request, intervalo $intervalo)
    {

        $em = $this->getDoctrine()->getManager();

        $sala= $em->getRepository('FCOMIcomBundle:Salas')->find($request->get('salas'));


        $intervalos = $intervalo->getId();
        $tema = new Tematica();



        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p  WHERE  p.intervalo = '$intervalos' ORDER BY p.posicion ASC";
        $ponencias = $em->createQuery($dql_p)->getResult();
        $dql_d ="SELECT d FROM FCOMIcomBundle:Debate d";
        $debate= $em->createQuery($dql_d)->getResult();

        $dql_r ="SELECT r FROM FCOMIcomBundle:Receso r";
        $receso= $em->createQuery($dql_r)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematica= $em->createQuery($dql_t)->getResult();

        $temaInter = new ArrayCollection();
        foreach($tematica as $tema){
            foreach($tema->getIntervalo() as $inter){
                if($inter->getId() == $intervalo->getId()){
                    $temaInter->add($tema);
                }
            }
            break;
        }




        return $this->render('FCOMIcomBundle:intervalo:index.html.twig', array(
            'ponencias' => $ponencias ,
            'debates' => $debate,
            'recesos' => $receso,
            'sala' => $sala,
            'tematica' => $temaInter,
            'intervalo' => $intervalo,

        ));
    }

    /**
     * Creates a new intervalo entity.
     *
     */
    public function newAction(Request $request, Salas $salas)
    {
        $em = $this->getDoctrine()->getManager();
        $tematica= $em->getRepository('FCOMIcomBundle:Tematica')->find($request->get('tematica'));



        $intervaloNuevo = new intervalo();

        $intervaloNuevo->setPorciento(11);
        $intervaloNuevo->setPosicion(0);
        $intervaloNuevo->setCantPonencias(0);
        $intervaloNuevo->setHoraInicio($salas->getHoraInicioActual());
        $intervaloNuevo->setHoraFinal($salas->getHoraInicioActual());
        $em->persist($intervaloNuevo);
        $tematica->addIntervalo($intervaloNuevo);
        $salas->addIntervalo($intervaloNuevo);
        $em->persist($tematica);
        $em->persist($salas);
        $em->flush();
        return $this->redirectToRoute('salas_programa_ponencias');

    }

    public function addPonenciaAction(Request $request, Ponencias $ponencia)
    {

        $em = $this->getDoctrine()->getManager();


        if($request->get('intervalo') != null){
            $intervalo = $em->getRepository('FCOMIcomBundle:intervalo')->find($request->get('intervalo'));
            $sala = $em->getRepository('FCOMIcomBundle:Salas')->find($request->get('sala'));
                $cant = $intervalo->getCantPonencias();
                $cant++;
                $intervalo->setCantPonencias($cant);

                $em->persist($intervalo);
                $ponencia->setIntervalo($intervalo);
                $ponencia->setAsignado(1);
                $em->persist($ponencia);
                $em->flush();
            return $this->redirectToRoute('salas_programa_ponencias');

        }

        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();

        $intervalo = $em->getRepository('FCOMIcomBundle:intervalo')->findAll();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematicas= $em->createQuery($dql_t)->getResult();

        $dql_s ="SELECT s FROM FCOMIcomBundle:Salas s";
        $sala= $em->createQuery($dql_s)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p WHERE p.asignado = 0";
        $ponencias= $em->createQuery($dql_p)->getResult();

        $intervaloNuevo = new ArrayCollection();

                foreach( $intervalo as $inter ){
                    foreach( $inter->getPonencias() as $ponen ){
                        foreach( $ponen->getAutor() as $autor ){
                            foreach($ponencia->getAutor() as $autorComp){
                                if($ponen->getId() != $ponencia->getId()){
                                    if($autor->getId() == $autorComp->getId()){
                                        $intervaloNuevo->add($ponen->getIntervalo());
                                    }
                                }
                            }
                        }
                    }
                }

        $respuesta = $request->get('respuesta');

        return $this->render('@FCOMIcom/intervalo/accion/addPonencia.html.twig', array(
            'sala' => $sala,
            'dia' => $dia,
            'intervalo' => $intervalo,
            'respuesta' => $respuesta,
            'tematicas' => $tematicas,
            'ponencias' => $ponencias,
            'ponencia' => $ponencia,
            'intervaloNuevo' => $intervaloNuevo,
        ));

    }

    /**
     * Finds and displays a intervalo entity.
     *
     */
    public function showAction(intervalo $intervalo)
    {
        $deleteForm = $this->createDeleteForm($intervalo);

        return $this->render('FCOMIcomBundle:intervalo:show.html.twig', array(
            'intervalo' => $intervalo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing intervalo entity.
     *
     */
    public function editAction(Request $request, intervalo $intervalo)
    {
        $deleteForm = $this->createDeleteForm($intervalo);
        $editForm = $this->createForm('FCOM\IcomBundle\Form\intervaloType', $intervalo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('intervalo_edit', array('id' => $intervalo->getId()));
        }

        return $this->render('FCOMIcomBundle:intervalo:edit.html.twig', array(
            'intervalo' => $intervalo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a intervalo entity.
     *
     */
    public function deleteAction(Request $request, intervalo $intervalo)
    {
        $form = $this->createDeleteForm($intervalo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($intervalo);
            $em->flush();
        }

        return $this->redirectToRoute('intervalo_index');
    }

    public function removerAction(Request $request, Ponencias $ponencia, intervalo $intervalo)
    {

        $em = $this->getDoctrine()->getManager();


        $ponencia->setIntervalo(null);
        $cant = $intervalo->getCantPonencias();
        $cant--;
        $intervalo->setCantPonencias($cant);

        $em->persist($ponencia);
        $em->persist($intervalo);
        $em->flush();

        return $this->redirectToRoute('salas_programa_ponencias', array('intervalo' => $intervalo->getId()));
    }

    public function accionAction(Request $request, intervalo $intervalo, Ponencias $ponencias)
    {

        $em = $this->getDoctrine()->getManager();
        $intervalos = $intervalo->getId();
        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p  WHERE  p.intervalo = '$intervalos' ORDER BY p.posicion ASC";
        $ponencia = $em->createQuery($dql_p)->getResult();
        $dql_d ="SELECT d FROM FCOMIcomBundle:Debate d";
        $debate= $em->createQuery($dql_d)->getResult();
        $dql_r ="SELECT r FROM FCOMIcomBundle:Receso r";
        $receso= $em->createQuery($dql_r)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematica= $em->createQuery($dql_t)->getResult();

        $sala= $em->getRepository('FCOMIcomBundle:Salas')->find($request->get('salas'));

        $temaInter = new ArrayCollection();
        foreach($tematica as $tema){
            foreach($tema->getIntervalo() as $inter){
                if($inter->getId() == $intervalo->getId()){
                    $temaInter->add($tema);
                }
            }
            break;
        }


        if($request->getMethod() == 'POST'){
            $ponenciaCambiar = $em->getRepository('FCOMIcomBundle:Ponencias')->find($request->get('cambiar'));

            $cambiar1 = $ponenciaCambiar->getPosicion();
            $cambiar2 = $ponencias->getPosicion();

            $ponencias->setPosicion($cambiar1);
            $ponenciaCambiar->setPosicion($cambiar2);


            $em->persist($ponencias);
            $em->persist($ponenciaCambiar);
            $em->flush();

            return $this->redirect('http://localhost:8080/AgenteGateway/ServletGateWay?accion=CambiarPonencias');


        }
        return $this->render('FCOMIcomBundle:intervalo/accion:accionCambiar.html.twig', array(
            'ponencias' => $ponencia ,
            'debates' => $debate,
            'recesos' => $receso,
            'ponenciaCambiar' => $ponencias->getId(),
            'intervalo' => $intervalo->getId(),
            'sala' => $sala,
            'tematica' => $temaInter,
        ));

    }

    /**
     * Creates a form to delete a intervalo entity.
     *
     * @param intervalo $intervalo The intervalo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(intervalo $intervalo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('intervalo_delete', array('id' => $intervalo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
