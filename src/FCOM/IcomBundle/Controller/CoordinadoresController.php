<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\Coordinadores;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Coordinadore controller.
 *
 */
class CoordinadoresController extends Controller
{
    /**
     * Lists all coordinadore entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $coordinadore = new Coordinadores();
        $form = $this->createForm('FCOM\IcomBundle\Form\CoordinadoresType', $coordinadore);
        $form->handleRequest($request);

        $dql_c ="SELECT c FROM FCOMIcomBundle:Coordinadores c";
        $coord= $em->createQuery($dql_c)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematica= $em->createQuery($dql_t)->getResult();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $coord,
            $request->query->getInt('page', 1),
            5
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coordinadore);
            $em->flush();

            return $this->redirectToRoute('coordinadores_index', array('id' => $coordinadore->getId()));
        }

        return $this->render('@FCOMIcom/coordinadores/index.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
            'tematica' => $tematica,
        ));
    }

    /**
     * Creates a new coordinadore entity.
     *
     */
    public function newAction(Request $request)
    {
        $coordinadore = new Coordinadore();
        $form = $this->createForm('FCOM\IcomBundle\Form\CoordinadoresType', $coordinadore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coordinadore);
            $em->flush();

            return $this->redirectToRoute('coordinadores_show', array('id' => $coordinadore->getId()));
        }

        return $this->render('@FCOMIcom/coordinadores/new.html.twig', array(
            'coordinadore' => $coordinadore,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a coordinadore entity.
     *
     */
    public function showAction(Coordinadores $coordinadore)
    {
        $deleteForm = $this->createDeleteForm($coordinadore);

        return $this->render('@FCOMIcom/coordinadores/show.html.twig', array(
            'coordinadore' => $coordinadore,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing coordinadore entity.
     *
     */
    public function editAction(Request $request, Coordinadores $coordinadore)
    {

        $em = $this->getDoctrine()->getManager();
        $tematica= $em->getRepository('FCOMIcomBundle:Tematica')->find($request->get('tematica'));
        $coordinadore->setApellidos($request->get('apellidos'));
        $coordinadore->setGradoCientifico($request->get('gradoCientifico'));
        $coordinadore->setNombre($request->get('nombre'));
        $coordinadore->setTematica($tematica);

        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('coordinadores_index', array('id' => $coordinadore->getId()));

    }

    /**
     * Deletes a coordinadore entity.
     *
     */
    public function deleteAction(Request $request, Coordinadores $coordinadore)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($coordinadore);
        $em->flush();

        return $this->redirectToRoute('coordinadores_index');
    }

    /**
     * Creates a form to delete a coordinadore entity.
     *
     * @param Coordinadores $coordinadore The coordinadore entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Coordinadores $coordinadore)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coordinadores_delete', array('id' => $coordinadore->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
