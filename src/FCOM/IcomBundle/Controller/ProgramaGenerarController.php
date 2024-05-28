<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\ProgramaGenerar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Programagenerar controller.
 *
 */
class ProgramaGenerarController extends Controller
{
    /**
     * Lists all programaGenerar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();


        $dql_p ="SELECT p FROM FCOMIcomBundle:ProgramaGenerar p";
        $programa= $em->createQuery($dql_p)->getResult();



        return $this->render('@FCOMIcom/programagenerar/index.html.twig', array(
            'programaGenerar' => $programa,
            'dia' => $dia,

        ));
    }

    /**
     * Creates a new programaGenerar entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $dql_d ="SELECT d FROM FCOMIcomBundle:Dia d";
        $dia= $em->createQuery($dql_d)->getResult();

        $dql_i ="SELECT i FROM FCOMIcomBundle:intervalo i";
        $intervalo= $em->createQuery($dql_i)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematicas= $em->createQuery($dql_t)->getResult();

        $dql_s ="SELECT s FROM FCOMIcomBundle:Salas s";
        $salas= $em->createQuery($dql_s)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:ProgramaGenerar p";
        $programa= $em->createQuery($dql_p)->getResult();

        $programaGenerar = new ProgramaGenerar();
        $form = $this->createForm('FCOM\IcomBundle\Form\ProgramaGenerarType', $programaGenerar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($programaGenerar);
            $em->flush();


            return $this->redirectToRoute('programagenerar_new');
        }

        return $this->render('@FCOMIcom/programagenerar/new.html.twig', array(
            'programaGenerar' => $programa,
            'dias' => $dia,
            'salas' => $salas,
            'intervalo' => $intervalo,
            'tematicas' => $tematicas,
            'form' => $form->createView(),

        ));
    }

    /**
     * Finds and displays a programaGenerar entity.
     *
     */
    public function showAction(ProgramaGenerar $programaGenerar)
    {
        $deleteForm = $this->createDeleteForm($programaGenerar);

        return $this->render('programagenerar/show.html.twig', array(
            'programaGenerar' => $programaGenerar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing programaGenerar entity.
     *
     */
    public function editAction(Request $request, ProgramaGenerar $programaGenerar)
    {

        $em = $this->getDoctrine()->getManager();
        $dia = $em->getRepository('FCOMIcomBundle:Dia')->find($request->get('dia'));

        $programaGenerar->setHoraInicio($request->get('horaInicio'));
        $programaGenerar->setHoraFinal($request->get('horaFinal'));
        $programaGenerar->setActividad($request->get('actividad'));
        $programaGenerar->setLugar($request->get('lugar'));
        $programaGenerar->setDia($dia);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('programagenerar_new');

    }

    /**
     * Deletes a programaGenerar entity.
     *
     */
    public function deleteAction(Request $request, ProgramaGenerar $programaGenerar)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($programaGenerar);
        $em->flush();


        return $this->redirectToRoute('programagenerar_new');
    }

    /**
     * Creates a form to delete a programaGenerar entity.
     *
     * @param ProgramaGenerar $programaGenerar The programaGenerar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProgramaGenerar $programaGenerar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('programagenerar_delete', array('id' => $programaGenerar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
