<?php

namespace FCOM\IcomBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FCOM\IcomBundle\Entity\Autor;
use FCOM\IcomBundle\Entity\Estado;
use FCOM\IcomBundle\Entity\Notificacion;
use FCOM\IcomBundle\Entity\Ponencias;
use FCOM\IcomBundle\Entity\PalabraClave;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;
use FCOM\IcomBundle\Entity\Document;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Ponencia controller.
 *
 */
class PonenciasController extends Controller
{
    /**
     * Lists all ponencia entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

       
        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p";
        $ponencias = $em->createQuery($dql_p)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematica = $em->createQuery($dql_t)->getResult();
    
        
        $dql_e ="SELECT e FROM FCOMIcomBundle:Estado e";
        $estado = $em->createQuery($dql_e)->getResult();


        if($request->get('records') != ""){
            $records = $request->get('records');
        }
        if($request->get('records') == ""){
            $records = 10;
        }
        $filtrarTitulo= "";
        $tematicabus = "";

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $ponencias,
            $request->query->getInt('page', 1),
            $records
        );

        return $this->render('FCOMIcomBundle:ponencias/admin:index.html.twig', array(
            'pagination' => $pagination,
            'estados' => $estado,
            'tematicas' => $tematica,

        ));
    }
    public function filtrarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $filtrarTitulo = $request->get('titulo');
        $filtrarTematica = $request->get('tematica');
        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p WHERE  p.titulo LIKE '%$filtrarTitulo' AND p.tematica = '$filtrarTematica'";
        $poenencias = $em->createQuery($dql_p)->getResult();

        $dql_t ="SELECT t FROM FCOMIcomBundle:Tematica t";
        $tematica = $em->createQuery($dql_t)->getResult();


        $dql_e ="SELECT e FROM FCOMIcomBundle:Estado e";
        $estado = $em->createQuery($dql_e)->getResult();

        if($request->get('records') != ""){
            $records = $request->get('records');
        }
        if($request->get('records') == ""){
            $records = 20;
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $poenencias,
            $request->query->getInt('page', 1),
            $records
        );

        return $this->render('@FCOMIcom/ponencias/admin/index.html.twig', array(
            'pagination' => $pagination,
            'estados' => $estado,
            'tematicas' => $tematica,



        ));
    }

    /**
     * Creates a new ponencia entity.
     *
     */
    public function nuevaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ponencia = new Ponencias();
        $palabraClave = new PalabraClave();
        $autor = new Autor();

        $form = $this->createForm('FCOM\IcomBundle\Form\PonenciasType', $ponencia, array('method' => 'POST'));
        $form->handleRequest($request);
        $form_autor = $this->createForm('FCOM\IcomBundle\Form\AutorType', $autor);
        $form_autor->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

            $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($user);

            $ponencia->addUsuario($usuario);
            $em = $this->getDoctrine()->getManager();
            $ponencia->setAsignado(0);
            $ponencia->setPosicion(0);
            $em->persist($ponencia);
            $em->flush();

            return $this->redirectToRoute('ponencias_autores', array(
                'id' => $ponencia->getId(),
                'nuevo' => $usuario,
            ));
        }

        return $this->render('FCOMIcomBundle:Ponencias:nueva.html.twig', array(
            'ponencia' => $ponencia,
            'form' => $form->createView(),
            'form_autor' => $form_autor->createView(),
        ));
    }

    /**
     * Finds and displays a ponencia entity.
     *
     */
    public function mostrarAction(Ponencias $ponencia)
    {
        if($ponencia->getDocument() == null){
            $this->addFlash(
                'validacion',
                'Se debe de subir el documento de la ponencia para continuar.'
            );
            return $this->redirectToRoute('ponencias_estado', array('id' => $ponencia->getId()));
        }
        else{

            $em = $this->getDoctrine()->getManager();
            $dql_e ="SELECT e FROM FCOMIcomBundle:Estado e WHERE e.estado = 'Ponencia en revisión'";
            $estado = $em->createQuery($dql_e)->getResult();
            $esta= $em->getRepository('FCOMIcomBundle:Estado')->find(4);
            $ponencia->setEstado($esta);

            $em->persist($ponencia);
            $em->flush();

            return $this->redirectToRoute('ponencias_estado', array('id' => $ponencia->getId()));
        }



    }

    public function autoresAction(Request $request, Ponencias $ponencia)    {


        $em = $this->getDoctrine()->getManager();
        if($ponencia->getAutor()->count() != 0){
            $aut = $em->getRepository('FCOMIcomBundle:Autor')->findAll();
            $autores = new ArrayCollection();
            foreach($ponencia->getAutor()  as $ponenAut){
                foreach($aut as $autBus ){
                    if($ponenAut->getId() != $autBus->getId()){
                        $autores->add($autBus);
                    }
                }
                break;
            }
        }
        else{
            $autores = $em->getRepository('FCOMIcomBundle:Autor')->findAll();
        }


        $autor = new Autor();
        $em = $this->getDoctrine()->getManager();
        $form_autor = $this->createForm('FCOM\IcomBundle\Form\AutorType', $autor, array('method' => 'POST'));
        $form_autor->handleRequest($request);
        $form = $this->createForm('FCOM\IcomBundle\Form\PonenciasType', $ponencia, array('method' => 'POST'));
        $form->handleRequest($request);

        if($request->get('delete') != ""){
            $em = $this->getDoctrine()->getManager();
            $ponencia->removeAutor($autor);
            $em->persist($ponencia);
            $em->remove($autor);
            $em->flush();
            return $this->redirectToRoute('ponencias_autores', array(
                'id' => $ponencia->getId(),
                'ponencias' => $ponencia,
                'autores' => $autores,
            ));
        }



        if($request->get('nombreBuscar') != "") {
            $autor = $em->getRepository('FCOMIcomBundle:Autor')->find($request->get('nombreBuscar'));
            $ponencia->addAutor($autor);
            $em->persist($ponencia);
            $em->flush();
            return $this->redirectToRoute('ponencias_autores', array(
                'id' => $ponencia->getId(),
                'ponencias' => $ponencia,
                'autores' => $autores,
            ));

        }


        if ($form_autor->isSubmitted() && $form_autor->isValid()){
            $ponencia->addAutor($autor);
            $em->persist($ponencia);
            $em->persist($autor);
            $em->flush();
            return $this->redirectToRoute('ponencias_autores', array(
                'id' => $ponencia->getId(),
                'ponencias' => $ponencia,
                'autores' => $autores,


            ));
        }


        return $this->render('FCOMIcomBundle:ponencias:autores.html.twig', array(
            'ponencias' => $ponencia,
            'autores' => $autores,
            'form_autor' => $form_autor->createView(),
            'form' => $form->createView(),
        ));
    }

    public function subirPonenciaAction(Request $request, Ponencias $ponencias)
    {


        if ($request->files->get('file') != "") {
            $document = new Document();
            $form = $request->files->get('file');
            if ($form->getClientMimeType() == "application/pdf") {
                $file = new File($form);
                $document->Upload($request);


                $ponencias->setDocument($document);

                $em = $this->getDoctrine()->getManager();
                $em->persist($ponencias);
                $em->persist($document);
                $em->flush();

                return $this->redirectToRoute('ponencias_estado', array('id' => $ponencias->getId()));

            } else {
                $this->addFlash(
                    'validacion',
                    'Solo se pude subir documentos pdf.'
                );
                return $this->redirectToRoute('ponencias_estado', array('id' => $ponencias->getId()));
            }


        } else {
            $this->addFlash(
                'validacion',
                'Seleccione un documento.'
            );
            return $this->redirectToRoute('ponencias_estado', array('id' => $ponencias->getId()));
        }
    }

    public function documentoEliminarAction(Request $request, Ponencias $ponencias)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($ponencias->getDocument());
        $em->flush();
        return $this->redirectToRoute('ponencias_estado', array('id' => $ponencias->getId()));
    }











    /**
     * Displays a form to edit an existing ponencia entity.
     *
     */
    public function editarAction(Request $request, Ponencias $ponencia)
    {

        $form = $this->createForm('FCOM\IcomBundle\Form\PonenciasType', $ponencia, array('method' => 'POST'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ponencia);
            $em->flush();
            return $this->redirectToRoute('ponencias_index', array(
                'id' => $ponencia->getId(),
                'ponencias' => $ponencia,
            ));
        }


        return $this->render('@FCOMIcom/ponencias/edit.html.twig', array(
            'ponencias' => $ponencia,
            'form' => $form->createView(),
        ));



    }
    public function cambiarEstadoAction(Request $request, Ponencias $ponencia)
    {

            $estado = new Estado();
            $notificacion = new Notificacion();
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $act = $em->getRepository('FCOMIcomBundle:Estado')->find($request->get('estado'));




            if($ponencia->getUsuario()->count() != 0){

            if($act->getEstado() == "Resumen aceptado"){
                $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($ponencia->getUsuario()->get(0)->getId());
                $notificacion->setNotificacion("Estimado usurio su resumen de ponencia ha sido aceptado");
                $notificacion->setTipo("aviso");
                $notificacion->setFecha(new \DateTime);
                $usuario->addNotificacion($notificacion);

                $em->persist($notificacion);
            }
            if($act->getEstado() == "Resumen no aceptado"){
                $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($ponencia->getUsuario()->get(0)->getId());
                $notificacion->setNotificacion("Estimado usurio su resumen de ponencia no ha sido aceptado");
                $notificacion->setTipo("aviso");
                $notificacion->setFecha(new \DateTime);
                $usuario->addNotificacion($notificacion);
                $em->persist($notificacion);
            }
            if($act->getEstado() == "Ponencia aceptada"){
                $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($ponencia->getUsuario()->get(0)->getId());
                $notificacion->setNotificacion("Estimado usurio su ponencia ha sido aceptada");
                $notificacion->setTipo("aviso");
                $notificacion->setFecha(new \DateTime);
                $usuario->addNotificacion($notificacion);
                $em->persist($notificacion);
            }
            if($act->getEstado() == "Ponencia no aceptada"){
                $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($ponencia->getUsuario()->get(0)->getId());
                $notificacion->setNotificacion("Estimado usurio su ponencia no ha sido aceptada");
                $notificacion->setTipo("aviso");
                $notificacion->setFecha(new \DateTime);
                $usuario->addNotificacion($notificacion);
                $em->persist($notificacion);
            }
            }


            $ponencia->setEstado($act);
            $em->persist($ponencia);
            $em->flush();

        }
        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p";
        $ponencias = $em->createQuery($dql_p)->getResult();

        return $this->redirectToRoute('ponencias_index', array('ponencias' => $ponencias));
    }

    /**
     * Deletes a ponencia entity.
     *
     */
    public function estadoAction(Request $request, Ponencias $ponencias)
    {
        $autor = new Autor();
        $em = $this->getDoctrine()->getManager();
        $autores = $em->getRepository('FCOMIcomBundle:Autor')->findAll();
        $form_autor = $this->createForm('FCOM\IcomBundle\Form\AutorType', $autor, array('method' => 'POST'));
        $form_autor->handleRequest($request);
        $form = $this->createForm('FCOM\IcomBundle\Form\PonenciasType', $ponencias, array('method' => 'POST'));
        $form->handleRequest($request);

        if($request->get('nombreBuscar') != null){
            $autor = $em->getRepository('FCOMIcomBundle:Autor')->find($request->get('nombreBuscar'));
            $ponencias->addAutor($autor);
            $em->persist($ponencias);
            $em->flush();
            return $this->redirectToRoute('ponencias_estado', array(
                'id' => $ponencias->getId(),
                'ponencias' => $ponencias,


            ));
        }
        if($request->getMethod() == 'POST'){
            $ponencias->addAutor($autor);

            $em->persist($ponencias);
            $em->persist($autor);
            $em->flush();
            return $this->redirectToRoute('ponencias_estado', array(
                'id' => $ponencias->getId(),
            ));
        }
        if($ponencias->getEstado()->getEstado() == 'Resumen en revisión'){
            return $this->render('FCOMIcomBundle:ponencias/estado:resumen_revision.html.twig', array(
                'ponencias' => $ponencias,
                'autores' => $autores,
                'form_autor' => $form_autor->createView(),
                'form' => $form->createView(),
            ));
        }
        if($ponencias->getEstado()->getEstado() == 'Resumen aceptado'){
            return $this->render('FCOMIcomBundle:ponencias/estado:resumen_aceptado.html.twig', array(
                'ponencias' => $ponencias,
                'autores' => $autores,
                'form_autor' => $form_autor->createView(),
                'form' => $form->createView(),
            ));
        }
        if($ponencias->getEstado()->getEstado() == 'Resumen no aceptado'){
            return $this->render('FCOMIcomBundle:ponencias/estado:resumen_no_aceptado.html.twig', array(
                'ponencias' => $ponencias,
                'autores' => $autores,
                'form_autor' => $form_autor->createView(),
                'form' => $form->createView(),
            ));
        }
        if($ponencias->getEstado()->getEstado() == 'Ponencia en revisión'){
            return $this->render('FCOMIcomBundle:ponencias/estado:ponencia_revision.html.twig', array(
                'ponencias' => $ponencias,
                'autores' => $autores,
                'form_autor' => $form_autor->createView(),
                'form' => $form->createView(),
            ));
        }
        if($ponencias->getEstado()->getEstado() == 'Ponencia no aceptada'){
            return $this->render('FCOMIcomBundle:ponencias/estado:ponencia_no_aceptada.html.twig', array(
                'ponencias' => $ponencias,
                'autores' => $autores,
                'form_autor' => $form_autor->createView(),
                'form' => $form->createView(),
            ));
        }
        if($ponencias->getEstado()->getEstado() == 'Ponencia aceptada'){
            return $this->render('FCOMIcomBundle:ponencias/estado:ponencia_aceptada.html.twig', array(
                'ponencias' => $ponencias,
                'autores' => $autores,
                'form_autor' => $form_autor->createView(),
                'form' => $form->createView(),
            ));
        }
    }

    /**
     * Deletes a ponencia entity.
     *
     */
    public function eliminarautorAction(Ponencias $ponencias, Autor $autor)
    {
            $em = $this->getDoctrine()->getManager();
            $ponencias->removeAutor($autor);
            $em->persist($ponencias);
            $em->remove($autor);
            $em->flush();

        return $this->redirectToRoute('ponencias_autores', array('id' => $ponencias->getId()));
    }

    public function eliminarAutorEstadoAction(Ponencias $ponencias, Autor $autor)
    {
        $em = $this->getDoctrine()->getManager();
        $ponencias->removeAutor($autor);
        $em->persist($ponencias);
        $em->remove($autor);
        $em->flush();

        return $this->redirectToRoute('ponencias_estado', array('id' => $ponencias->getId()));
    }



    public function eliminarAction(Request $request, Ponencias $ponencia)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($ponencia);
            $em->flush();
        return $this->redirectToRoute('ponencias_index');
    }

    /**
     * Creates a form to delete a ponencia entity.
     *
     */
    private function createDeleteForm(Ponencias $ponencia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ponencias_eliminar', array('id' => $ponencia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function document_generalAction(Request $request, Ponencias $ponencias)
    {

        $document = new Document();
        $document->Upload($request);
        $ponencias->setDocument($document);
        $em = $this->getDoctrine()->getManager();
        $em->persist($ponencias);
        $em->persist($document);
        $em->flush();

        return $this->redirectToRoute('ponencias_estado', array('id' => $ponencias->getId()));

    }
}
