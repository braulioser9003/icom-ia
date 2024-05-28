<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\Noticias;
use FCOM\IcomBundle\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;






/**
 * Noticia controller.
 *
 */
class NoticiasController extends Controller
{
    /**
     * Listar todads las noticias.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $dql ="SELECT n FROM FCOMIcomBundle:Noticias n";
        $noticias = $em->createQuery($dql)->getResult();

        return $this->render('FCOMIcomBundle:noticias:index.html.twig', array(
            'noticias' => $noticias,
        ));
    }

    /**
     * Crear un nueva Noticia
     *
     */
    public function nuevaAction(Request $request)
    {

        $noticia = new Noticias();
        
        $form = $this->createForm('FCOM\IcomBundle\Form\NoticiasType', $noticia);
        
        
        $form->handleRequest($request);
        $document = new Document();

                    

       if ($form->isSubmitted() && $form->isValid()) {


            $document->Upload($request);


            $noticia->setDocument($document);

            $em = $this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->persist($document);
            $em->flush();
            
            return $this->redirectToRoute('noticias_mostrar', array(
                'id' => $noticia->getId()
            ));
        }
        
        return $this->render('FCOMIcomBundle:noticias:nueva.html.twig', array(
            'noticias' => $noticia,
            'form' => $form->createView(),
            'document' => $document
        ));

    }
    /*public function documentAction(Noticias $noticia, Document $document)
    {
        $em = $this->getDoctrine()->getManager();
        $update = $em->getRepository('FCOMIcomBundle:Noticias')->find($noticia->getId());
        $update->setDocument($document);
        $em->flush();
        return $this->render('FCOMIcomBundle:noticias:mostrar.html.twig', array(
            'noticia' => $noticia
        ));
        
    }*/
   

    /**
     * Finds and displays a noticia entity.
     *
     */
    public function mostrarAction(Noticias $noticias)
    {



        return $this->render('FCOMIcomBundle:noticias:mostrar.html.twig', array(
            'noticia' => $noticias
        ));
    }

    /**
     * Displays a form to edit an existing noticia entity.
     *
     */
    public function editarAction(Request $request, Noticias $noticia)
    {
        $deleteForm = $this->createDeleteForm($noticia);
        $editForm = $this->createForm('FCOM\IcomBundle\Form\NoticiasType', $noticia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('noticias_mostrar', array('id' => $noticia->getId()));
        }

        return $this->render('FCOMIcomBundle:noticias:editar.html.twig', array(
            'noticia' => $noticia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a noticia entity.
     *
     */
    public function eliminarAction(Request $request, Noticias $noticia)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($noticia);
            $em->flush();


        return $this->redirectToRoute('noticias_index');
    }

    /**
     * Creates a form to delete a noticia entity.
     *
     * @param Noticias $noticia The noticia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Noticias $noticia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('noticias_eliminar', array('id' => $noticia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
