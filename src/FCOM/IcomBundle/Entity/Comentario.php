<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentario
 *
 * @ORM\Table(name="comentario")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\ComentarioRepository")
 */
class Comentario
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
     *
     * @ORM\Column(name="asunto", type="string", length=255)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     */
    private $comentario;
    
    /**
     * @ORM\ManyToOne(targetEntity="Noticias", inversedBy="comentario")
     * @ORM\JoinColumn(name="noticias_id", referencedColumnName="id")
     */
    private $noticias;


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
     * Set asunto
     *
     * @param string $asunto
     * @return Comentario
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string 
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set noticias
     *
     * @param \FCOM\IcomBundle\Entity\Noticias $noticias
     * @return Comentario
     */
    public function setNoticias(\FCOM\IcomBundle\Entity\Noticias $noticias = null)
    {
        $this->noticias = $noticias;

        return $this;
    }

    /**
     * Get noticias
     *
     * @return \FCOM\IcomBundle\Entity\Noticias 
     */
    public function getNoticias()
    {
        return $this->noticias;
    }
}
