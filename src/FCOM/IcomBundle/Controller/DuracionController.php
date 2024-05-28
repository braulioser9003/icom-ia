<?php

namespace FCOM\IcomBundle\Controller;

use Symfony\Component\Validator\Tests\Fixtures\Entity;
use FCOM\IcomBundle\Entity\Duracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Duracion controller.
 *
 */
class DuracionController extends Controller
{
    /**
     * Lists all duracion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $duracions = $em->getRepository('FCOMIcomBundle:Duracion')->findAll();

        return $this->render('@FCOMIcom/duracion/index.html.twig', array(
            'duracions' => $duracions,
        ));
    }

    /**
     * Creates a new duracion entity.
     *
     */
    public function newAction(Request $request)
    {
        $duracion = new Duracion();
        $form = $this->createForm('FCOM\IcomBundle\Form\DuracionType', $duracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($duracion);
            $em->flush();

            return $this->redirectToRoute('duracion_show', array('id' => $duracion->getId()));
        }

        return $this->render('@FCOMIcom/duracion/new.html.twig', array(
            'duracion' => $duracion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a duracion entity.
     *
     */
    public function showAction(Duracion $duracion)
    {
        $deleteForm = $this->createDeleteForm($duracion);

        return $this->render('@FCOMIcom/duracion/show.html.twig', array(
            'duracion' => $duracion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing duracion entity.
     *
     */
    public function editAction(Request $request, Duracion $duracion)
    {
        $em = $this->getDoctrine()->getManager();
        $duracion->setExpPonencias($request->get('expPonencias'));
        $duracion->setPregPonencias($request->get('pregPonencias'));
        $duracion->setDebate($request->get('debate'));
        $duracion->setReceso($request->get('receso'));
        $duracion->setIntermedio($request->get('intermedio'));
        $duracion->setCantPoster($request->get('cantPoster'));

        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('salas_index');
    }

    /**
     * Deletes a duracion entity.
     *
     */
    public function deleteAction(Request $request, Duracion $duracion)
    {
        $form = $this->createDeleteForm($duracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($duracion);
            $em->flush();
        }

        return $this->redirectToRoute('duracion_index');
    }

    /**
     * Creates a form to delete a duracion entity.
     *
     * @param Duracion $duracion The duracion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Duracion $duracion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('duracion_delete', array('id' => $duracion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
