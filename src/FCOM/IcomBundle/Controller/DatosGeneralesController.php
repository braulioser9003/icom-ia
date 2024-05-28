<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\DatosGenerales;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Datosgenerale controller.
 *
 */
class DatosGeneralesController extends Controller
{
    /**
     * Lists all datosGenerale entities.
     *
     */
    public function indexAction(Request $request)
    {
        $datosGenerale = new DatosGenerales();
        $em = $this->getDoctrine()->getManager();
        $datos= $em->getRepository('FCOMIcomBundle:DatosGenerales')->findAll();
        $form = $this->createForm('FCOM\IcomBundle\Form\DatosGeneralesType', $datosGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $datosGenerale->setEstadoPrograma(0);
            $em->persist($datosGenerale);
            $em->flush();

            return $this->redirectToRoute('datosgenerales_index', array('id' => $datosGenerale->getId()));
        }

        return $this->render('@FCOMIcom/datosgenerales/index.html.twig', array(
            'datosGenerale' => $datosGenerale,
            'form' => $form->createView(),
            'datos' => $datos,
        ));
    }

    /**
     * Creates a new datosGenerale entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('FCOM\IcomBundle\Form\DatosGeneralesType', $datosGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($datosGenerale);
            $em->flush();

            return $this->redirectToRoute('datosgenerales_show', array('id' => $datosGenerale->getId()));
        }

        return $this->render('@FCOMIcom/datosgenerales/new.html.twig', array(
            'datosGenerale' => $datosGenerale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a datosGenerale entity.
     *
     */
    public function showAction(DatosGenerales $datosGenerale)
    {
        $deleteForm = $this->createDeleteForm($datosGenerale);

        return $this->render('@FCOMIcom/datosgenerales/show.html.twig', array(
            'datosGenerale' => $datosGenerale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing datosGenerale entity.
     *
     */
    public function editAction(Request $request, DatosGenerales $datosGenerale)
    {

        $editForm = $this->createForm('FCOM\IcomBundle\Form\DatosGeneralesType', $datosGenerale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('datosgenerales_edit', array('id' => $datosGenerale->getId()));
        }

        return $this->render('@FCOMIcom/datosgenerales/edit.html.twig', array(
            'datosGenerale' => $datosGenerale,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a datosGenerale entity.
     *
     */
    public function deleteAction(Request $request, DatosGenerales $datosGenerale)
    {
        $form = $this->createDeleteForm($datosGenerale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($datosGenerale);
            $em->flush();
        }

        return $this->redirectToRoute('datosgenerales_index');
    }

    /**
     * Creates a form to delete a datosGenerale entity.
     *
     * @param DatosGenerales $datosGenerale The datosGenerale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DatosGenerales $datosGenerale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('datosgenerales_delete', array('id' => $datosGenerale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
