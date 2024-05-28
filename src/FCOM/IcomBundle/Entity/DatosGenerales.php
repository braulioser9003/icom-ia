<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DatosGenerales
 *
 * @ORM\Table(name="datos_generales")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\DatosGeneralesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class DatosGenerales
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
     * @Assert\NotBlank(message="Inserte el título del sitio")
     *
     * @ORM\Column(name="tituloSitio", type="string", length=255)
     */
    private $tituloSitio;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Inserte la fecha de inicio del evento.")
     *
     * @ORM\Column(name="fechaInicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *  @Assert\NotBlank(message="Inserte la fecha final del evento.")
     *
     * @ORM\Column(name="fechaFinal", type="date")
     */
    private $fechaFinal;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte la cuenta de twitter.")
     *
     * @ORM\Column(name="cuentaTuitter", type="string", length=255)
     */
    private $cuentaTuitter;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte la cuenta de facebook.")
     *
     * @ORM\Column(name="cuentaFacebook", type="string", length=255)
     */
    private $cuentaFacebook;

    /**
     * @var string
     * @Assert\NotBlank(message="Inserte el correo de ICOM.")
     *  @Assert\Email(
     * message = "Inserte un correo válido",
     * checkMX = false
     * )
     *
     * @ORM\Column(name="correoTcom", type="string", length=255)
     */
    private $correoTcom;

    /**
     * @var int
     *
     * @ORM\Column(name="estadoPrograma", type="integer")
     */
    private $estadoPrograma;


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
     * Set tituloSitio
     *
     * @param string $tituloSitio
     * @return DatosGenerales
     */
    public function setTituloSitio($tituloSitio)
    {
        $this->tituloSitio = $tituloSitio;

        return $this;
    }

    /**
     * Get tituloSitio
     *
     * @return string 
     */
    public function getTituloSitio()
    {
        return $this->tituloSitio;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return DatosGenerales
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     * @return DatosGenerales
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime 
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set cuentaTuitter
     *
     * @param string $cuentaTuitter
     * @return DatosGenerales
     */
    public function setCuentaTuitter($cuentaTuitter)
    {
        $this->cuentaTuitter = $cuentaTuitter;

        return $this;
    }

    /**
     * Get cuentaTuitter
     *
     * @return string 
     */
    public function getCuentaTuitter()
    {
        return $this->cuentaTuitter;
    }

    /**
     * Set cuentaFacebook
     *
     * @param string $cuentaFacebook
     * @return DatosGenerales
     */
    public function setCuentaFacebook($cuentaFacebook)
    {
        $this->cuentaFacebook = $cuentaFacebook;

        return $this;
    }

    /**
     * Get cuentaFacebook
     *
     * @return string 
     */
    public function getCuentaFacebook()
    {
        return $this->cuentaFacebook;
    }

    /**
     * Set correoTcom
     *
     * @param string $correoTcom
     * @return DatosGenerales
     */
    public function setCorreoTcom($correoTcom)
    {
        $this->correoTcom = $correoTcom;

        return $this;
    }

    /**
     * Get correoTcom
     *
     * @return string 
     */
    public function getCorreoTcom()
    {
        return $this->correoTcom;
    }

    /**
     * Set estadoPrograma
     *
     * @param integer $estadoPrograma
     * @return DatosGenerales
     */
    public function setEstadoPrograma($estadoPrograma)
    {
        $this->estadoPrograma = $estadoPrograma;

        return $this;
    }

    /**
     * Get estadoPrograma
     *
     * @return integer
     */
    public function getEstadoPrograma()
    {
        return $this->estadoPrograma;
    }
}
