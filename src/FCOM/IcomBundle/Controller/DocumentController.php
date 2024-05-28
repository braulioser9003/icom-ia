<?php

namespace FCOM\IcomBundle\Controller;

use FCOM\IcomBundle\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DocumentController extends Controller
{
    public function uploadAction(Request $request)
    {
             $document = new Document();
         
        
        if ($request->getMethod() == 'POST') {
            $form = $request->files->get('file');
            $document->Upload($request);
            /*//Instancio la clase File
            $file = new File($form);
            
            //Muevo el Archivo Hacia la Carpeta uploads/document
            $file->move($document->getUploadRootDir(), $form->getClientOriginalName());
            
            //llenos los valores de mi tabla con el nombre del archivo y la direccion
            $document->setPath($document->getUploadDir());
            $document->setName($form->getClientOriginalName());*/
                        
            //ejecuto mi consulta a la base de datos
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($document);
            $em->flush();
            print_r($document->getId());
            exit();
            $this->redirect($this->generateUrl('noticias_index'));
        }
        return $this->render('@FCOMIcom/document.html.twig', array(
            'noticia' => $document
            
        ));
    
    }
}
