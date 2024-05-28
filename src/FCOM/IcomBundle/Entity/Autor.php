<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Autor
 *
 * @ORM\Table(name="autor")
 *
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\AutorRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @UniqueEntity(
 * fields={"correo"},
 * message="El correo ya existe."
 * )
 */
class Autor
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
     * @Assert\NotBlank(message="Inserte el nombre del autor")
     * @ORM\Column(name="Nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte los apellidos")
     * @ORM\Column(name="Apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte el correo")
     * @Assert\Email(
     * message = "Inserte un correo válido",
     * checkMX = false
     * )
     * @ORM\Column(name="correo", type="string", length=255)
     */
    private $correo;

    /**
     * @var bool
     *
     * @ORM\Column(name="pertenece_institucion", type="boolean")
     */
    private $perteneceInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255)
     */
    private $institucion;


    
    /**
     * @Assert\NotBlank(message="Selecciones un pais")
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="autor")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $pais;
    
    /**
     * @Assert\NotBlank(message="Inserte el tipo de autor")
     * @ORM\ManyToOne(targetEntity="TipoAutor", inversedBy="autor")
     * @ORM\JoinColumn(name="tipoAutor_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tipoAutor;
    
    
    public function __construct()
    {
        $this->pais = new ArrayCollection();
        $this->tipoAutor = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Autor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Autor
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Autor
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set perteneceInstitucion
     *
     * @param boolean $perteneceInstitucion
     * @return Autor
     */
    public function setPerteneceInstitucion($perteneceInstitucion)
    {
        $this->perteneceInstitucion = $perteneceInstitucion;

        return $this;
    }

    /**
     * Get perteneceInstitucion
     *
     * @return boolean 
     */
    public function getPerteneceInstitucion()
    {
        return $this->perteneceInstitucion;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     * @return Autor
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }



    /**
     * Set pais
     *
     * @param \FCOM\IcomBundle\Entity\Pais $pais
     * @return Autor
     */
    public function setPais(\FCOM\IcomBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \FCOM\IcomBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set tipoAutor
     *
     * @param \FCOM\IcomBundle\Entity\TipoAutor $tipoAutor
     * @return Autor
     */
    public function setTipoAutor(\FCOM\IcomBundle\Entity\TipoAutor $tipoAutor = null)
    {
        $this->tipoAutor = $tipoAutor;

        return $this;
    }

    /**
     * Get tipoAutor
     *
     * @return \FCOM\IcomBundle\Entity\TipoAutor 
     */
    public function getTipoAutor()
    {
        return $this->tipoAutor;
    }
}
