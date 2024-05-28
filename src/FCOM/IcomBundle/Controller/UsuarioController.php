<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{

    public function homeAction(){

        $em = $this->getDoctrine()->getManager();
        $dql_n ="SELECT n FROM FCOMIcomBundle:Notificacion n";
        $notificacion = $em->createQuery($dql_n)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p";
        $ponencia = $em->createQuery($dql_p)->getResult();



        $user = $this->get('security.token_storage')->getToken()->getUser();
        $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($user->getId());




        return $this->render('@FCOMIcom/usuario/perfil.html.twig', array(
            'notificacion' => $notificacion,
            'ponencias' => $ponencia,
            'user' => $user,
            'usuario' => $usuario,
        ));


    }
    /**
     * Lists all usuario entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('FCOMIcomBundle:Usuario')->findAll();


        if($request->get('records') != ""){
            $records = $request->get('records');
        }
        if($request->get('records') == ""){
            $records = 10;
        }
        $filtrarRole = "";
        $filtrarUsername = "";

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $usuarios,
            $request->query->getInt('page', 1),
            $records
        );
        $editForm = $this->createForm('FCOM\IcomBundle\Form\UsuarioEditType');
        $editForm->handleRequest($request);

        return $this->render('@FCOMIcom/usuario/admin/index.html.twig', array(
            'usuarios' => $pagination,
            'usuarioBuscar' => $filtrarUsername,
            'roleBuscar' =>  $filtrarRole,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a new usuario entity.
     *
     */
    public function newAction(Request $request)
    {
        $usuario = new Usuario();
        $form = $this->createForm('FCOM\IcomBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($usuario, $password);
            $isActive = true;

            $usuario->setRole($request->get('role'));
            $usuario->setIsActive(true);



            $usuario->setPassword($encoded);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('fcom_icom_login', array('id' => $usuario->getId()));
        }



        return $this->render('@FCOMIcom/usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }
    public function cambiarContraseñaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($user->getId());
        $validacion = 0;

        if($request->get('nuevaContraseña') != $request->get('repetirNuevaContraseña') ){
            $this->addFlash(
                'validacion',
                'Las contraseña no son iguales.'
            );
        }
        if($request->get('nuevaContraseña') == $request->get('repetirNuevaContraseña') ){
            $password = $request->get('nuevaContraseña');
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($usuario, $password);
            $usuario->setPassword($encoded);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();
            $this->addFlash(
                'confirmacion',
                'La contraseña ha sido guardada.'
            );
        }

        return $this->redirectToRoute('usuario_cuenta');

    }

    public function cuentaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $usuario = $em->getRepository('FCOMIcomBundle:Usuario')->find($user->getId());
        $form = $this->createForm('FCOM\IcomBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);


        $dql_n ="SELECT n FROM FCOMIcomBundle:Notificacion n";
        $notificacion = $em->createQuery($dql_n)->getResult();

        $dql_p ="SELECT p FROM FCOMIcomBundle:Ponencias p";
        $ponencia = $em->createQuery($dql_p)->getResult();


        $flassh = $request->get('flassh');


        if($flassh != null){
            $this->addFlash(
                'confirmacion',
                $flassh
            );
        }



        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($usuario, $password);
            $isActive = true;

            $usuario->setRole($usuario->getRole());
            $usuario->setIsActive(true);

            $usuario->setPassword($encoded);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $flassh = "La cuenta ha sido actualizada.";

            return $this->redirectToRoute('usuario_cuenta', array('id' => $usuario->getId(), 'flassh' => $flassh));
        }




        return $this->render('@FCOMIcom/usuario/cuenta.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
            'notificacion' => $notificacion,
            'ponencias' => $ponencia,
            'user' => $user,


        ));
    }

    /**
     * Finds and displays a usuario entity.
     *
     */
    public function showAction(Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('@FCOMIcom/usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuario entity.
     *
     */
    public function editAction(Request $request, Usuario $usuario)
    {
        $usuario->setUsername($request->get('username'));
        $usuario->setNombre($request->get('nombre'));
        $usuario->setApellidos($request->get('apellidos'));
        $usuario->setEmail($request->get('email'));
        $usuario->setRole($request->get('role'));
        if($request->get('isActive') == 'on')
        {
            $usuario->setIsActive(true);
        }
        else{
            $usuario->setIsActive(false);
        }
        var_dump($request->get('isActive'));

        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('usuario_index');


    }



    /**
     * Deletes a usuario entity.
     *
     */
    public function deleteAction(Usuario $usuario)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();


        return $this->redirectToRoute('usuario_index');
    }

    public function filtrarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $filtrarRole = $request->get('role');
        $filtrarUsername = $request->get('username');
        $dql_u ="SELECT u FROM FCOMIcomBundle:Usuario u WHERE  u.username LIKE '%$filtrarUsername%' AND u.role = '$filtrarRole'";
        $usuarios = $em->createQuery($dql_u)->getResult();

        if($request->get('records') != ""){
            $records = $request->get('records');
        }
        if($request->get('records') == ""){
            $records = 10;
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $usuarios,
            $request->query->getInt('page', 1),
            $records
        );

        return $this->render('@FCOMIcom/usuario/admin/index.html.twig', array(
            'usuarios' => $pagination,
            'usuarioBuscar' => $request->get('username'),
            'roleBuscar' =>  $filtrarRole,

        ));
    }

    /**
     * Creates a form to delete a usuario entity.
     *
     * @param Usuario $usuario The usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
