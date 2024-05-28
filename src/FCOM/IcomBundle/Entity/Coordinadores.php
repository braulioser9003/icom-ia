<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Coordinadores
 *
 * @ORM\Table(name="coordinadores") *
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\CoordinadoresRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Coordinadores
{
    /**
     * @var int
     *
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte el nombre del coordinador")
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte los apellidos del coordinador")
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte el grado científico")
     *
     * @ORM\Column(name="gradoCientifico", type="string", length=255)
     */
    private $gradoCientifico;

    /**
     * @Assert\NotBlank(message="Seleccione la Temática")
     * @ORM\ManyToOne(targetEntity="Tematica", inversedBy="coordinadores")
     * @ORM\JoinColumn(name="tematica_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tematica;


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
     * @return Coordinadores
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
     * @return Coordinadores
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
     * Set gradoCientifico
     *
     * @param string $gradoCientifico
     * @return Coordinadores
     */
    public function setGradoCientifico($gradoCientifico)
    {
        $this->gradoCientifico = $gradoCientifico;

        return $this;
    }

    /**
     * Get gradoCientifico
     *
     * @return string 
     */
    public function getGradoCientifico()
    {
        return $this->gradoCientifico;
    }

    /**
     * Set tematica
     *
     * @param \FCOM\IcomBundle\Entity\Tematica $tematica
     * @return Coordinadores
     */
    public function setTematica(\FCOM\IcomBundle\Entity\Tematica $tematica = null)
    {
        $this->tematica = $tematica;

        return $this;
    }

    /**
     * Get tematica
     *
     * @return \FCOM\IcomBundle\Entity\Tematica 
     */
    public function getTematica()
    {
        return $this->tematica;
    }
}
