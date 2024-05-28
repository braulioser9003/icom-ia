<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\Autor;
use FCOM\IcomBundle\Entity\Ponencias;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Autor controller.
 *
 *
 */
class AutorController extends Controller
{
    /**
     * Lists all autor entities.
     *
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $autors = $em->getRepository('FCOMIcomBundle:Autor')->findAll();

        return $this->render('@FCOMIcom/autor/index.html.twig', array(
            'autors' => $autors,
        ));
    }

    /**
     * Creates a new autor entity.
     *
     *
     */
    public function newAction(Request $request)
    {
        $autor = new Autor();
        $ponencia = new Ponencias();
        $form = $this->createForm('FCOM\IcomBundle\Form\AutorType', $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($autor);
            $em->flush();

            return $this->redirectToRoute('ponencias_nueva', array('autor' => $autor));
        }

        return $this->render('@FCOMIcom/autor/new.html.twig', array(
            'autor' => $autor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a autor entity.
     *
     *
     */
    public function showAction(Autor $autor)
    {
        $deleteForm = $this->createDeleteForm($autor);

        return $this->render('autor/mostrar.html.twig', array(
            'autor' => $autor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing autor entity.
     *
     *
     */
    public function editAction(Request $request, Autor $autor)
    {
        $deleteForm = $this->createDeleteForm($autor);
        $editForm = $this->createForm('FCOM\IcomBundle\Form\AutorType', $autor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('autor_edit', array('id' => $autor->getId()));
        }

        return $this->render('autor/editar.html.twig', array(
            'autor' => $autor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a autor entity.
     *
     *
     */
    public function deleteAction(Request $request, Autor $autor)
    {
        $form = $this->createDeleteForm($autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($autor);
            $em->flush();
        }

        return $this->redirectToRoute('autor_index');
    }

    /**
     * Creates a form to delete a autor entity.
     *
     * @param Autor $autor The autor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Autor $autor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('autor_delete', array('id' => $autor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
