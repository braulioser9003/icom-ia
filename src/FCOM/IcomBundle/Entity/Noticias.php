<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FCOM\IcomBundle\Twig\Extension\document;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Noticias
 *
 * @ORM\Table(name="noticias")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\NoticiasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Noticias
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo es requerido")
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo es requerido")
     * @ORM\Column(name="resumen", type="string", length=255)
     */
    private $resumen;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo es requerido")
     * @ORM\Column(name="contenido", type="text")
     */
    private $contenido;

    /**
     * @var
     *
     * @ORM\Column(name="publicado", type="boolean")
     */
    private $publicado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actualizado", type="datetime")
     */
    private $actualizado;
    
    /**
     * @ORM\ManyToOne(targetEntity="Etiqueta", inversedBy="noticias")
     * @ORM\JoinColumn(name="etiqueta_id", referencedColumnName="id")
     *
     */
    private $etiqueta;
    
    /**
     * @ORM\OneToOne(targetEntity="Document")
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $document;
   
    
    /**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="noticias")
     */
    private $comentario;
    
    public function __construct()
    {
        $this->comentario = new ArrayCollection();
        
    }
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Noticias
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return Noticias
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Noticias
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set etiqueta
     *
     * @param \FCOM\IcomBundle\Entity\Etiqueta $etiqueta
     * @return Noticias
     */
    public function setEtiqueta(\FCOM\IcomBundle\Entity\Etiqueta $etiqueta = null)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return \FCOM\IcomBundle\Entity\Etiqueta 
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Add comentario
     *
     * @param \FCOM\IcomBundle\Entity\Comentario $comentario
     * @return Noticias
     */
    public function addComentario(\FCOM\IcomBundle\Entity\Comentario $comentario)
    {
        $this->comentario[] = $comentario;

        return $this;
    }

    /**
     * Remove comentario
     *
     * @param \FCOM\IcomBundle\Entity\Comentario $comentario
     */
    public function removeComentario(\FCOM\IcomBundle\Entity\Comentario $comentario)
    {
        $this->comentario->removeElement($comentario);
    }

    /**
     * Get comentario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set publicado
     *
     * @param boolean $publicado
     * @return Noticias
     */
    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return boolean 
     */
    public function getPublicado()
    {
        return $this->publicado;
    }

    /**
     * Set actualizado
     * @ORM\PrePersist
     *
     * @param \DateTime $actualizado
     * @return Noticias
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = new \DateTime();
    }

    /**
     * Get actualizado
     *
     * @return \DateTime 
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }

    
    /**
     * Set document
     *
     * @param \FCOM\IcomBundle\Entity\Document $document
     * @return Noticias
     */
    public function setDocument(\FCOM\IcomBundle\Entity\Document $document = null)
    {
        
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \FCOM\IcomBundle\Entity\Document 
     */
    public function getDocument()
    {
        return $this->document;
    }
}
