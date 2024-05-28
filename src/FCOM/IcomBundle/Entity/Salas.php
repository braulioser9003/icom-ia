<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Salas
 *
 * @ORM\Table(name="salas")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\SalasRepository")
 */
class Salas
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
     * @ORM\Column(name="Nombre", type="string", length=808)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="Capacidad", type="integer")
     */
    private $capacidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicio", type="time")
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaFinal", type="time")
     */
    private $horaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoActividad", type="string", length=255)
     */
    private $tipoActividad;

    /**
     * @ORM\ManyToOne(targetEntity="Dia", inversedBy="salas")
     * @ORM\JoinColumn(name="dia_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $dia;

    /**
     * @ORM\ManyToOne(targetEntity="Duracion", inversedBy="salas", cascade={"persist"})
     * @ORM\JoinColumn(name="duración_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $duracion;

    /**
     * @var int
     *
     * @ORM\Column(name="asignado", type="integer")
     */
    private $asignado;


    /**
     * @ORM\OneToMany(targetEntity="Combinacion", mappedBy="salas")
     */
    private $combinacion;

    /**
     * @ORM\ManyToMany(targetEntity="intervalo", cascade={"persist"})
     * @ORM\JoinTable(name="salas_intervalo",
     *      joinColumns={@ORM\JoinColumn(name="salas_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="intervalo_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    private $intervalo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicioActual", type="time")
     */
    private $horaInicioActual;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidadActPonencias", type="integer")
     */
    private $cantidadActPonencias;








    /**
     * Constructor
     */
    public function __construct()
    {
        $this->combinacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->intervalo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Salas
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
     * Set capacidad
     *
     * @param integer $capacidad
     * @return Salas
     */
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    /**
     * Get capacidad
     *
     * @return integer 
     */
    public function getCapacidad()
    {
        return $this->capacidad;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Salas
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinal
     *
     * @param \DateTime $horaFinal
     * @return Salas
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return \DateTime 
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    /**
     * Set tipoActividad
     *
     * @param string $tipoActividad
     * @return Salas
     */
    public function setTipoActividad($tipoActividad)
    {
        $this->tipoActividad = $tipoActividad;

        return $this;
    }

    /**
     * Get tipoActividad
     *
     * @return string 
     */
    public function getTipoActividad()
    {
        return $this->tipoActividad;
    }

    /**
     * Set asignado
     *
     * @param integer $asignado
     * @return Salas
     */
    public function setAsignado($asignado)
    {
        $this->asignado = $asignado;

        return $this;
    }

    /**
     * Get asignado
     *
     * @return integer 
     */
    public function getAsignado()
    {
        return $this->asignado;
    }

    /**
     * Set dia
     *
     * @param \FCOM\IcomBundle\Entity\Dia $dia
     * @return Salas
     */
    public function setDia(\FCOM\IcomBundle\Entity\Dia $dia = null)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return \FCOM\IcomBundle\Entity\Dia 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set duracion
     *
     * @param \FCOM\IcomBundle\Entity\Duracion $duracion
     * @return Salas
     */
    public function setDuracion(\FCOM\IcomBundle\Entity\Duracion $duracion = null)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return \FCOM\IcomBundle\Entity\Duracion 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Add combinacion
     *
     * @param \FCOM\IcomBundle\Entity\Combinacion $combinacion
     * @return Salas
     */
    public function addCombinacion(\FCOM\IcomBundle\Entity\Combinacion $combinacion)
    {
        $this->combinacion[] = $combinacion;

        return $this;
    }

    /**
     * Remove combinacion
     *
     * @param \FCOM\IcomBundle\Entity\Combinacion $combinacion
     */
    public function removeCombinacion(\FCOM\IcomBundle\Entity\Combinacion $combinacion)
    {
        $this->combinacion->removeElement($combinacion);
    }

    /**
     * Get combinacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCombinacion()
    {
        return $this->combinacion;
    }

    /**
     * Add intervalo
     *
     * @param \FCOM\IcomBundle\Entity\intervalo $intervalo
     * @return Salas
     */
    public function addIntervalo(\FCOM\IcomBundle\Entity\intervalo $intervalo)
    {
        $this->intervalo[] = $intervalo;

        return $this;
    }

    /**
     * Remove intervalo
     *
     * @param \FCOM\IcomBundle\Entity\intervalo $intervalo
     */
    public function removeIntervalo(\FCOM\IcomBundle\Entity\intervalo $intervalo)
    {
        $this->intervalo->removeElement($intervalo);
    }

    /**
     * Get intervalo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIntervalo()
    {
        return $this->intervalo;
    }

    /**
     * Set horaInicioActual
     *
     * @param \DateTime $horaInicioActual
     * @return Salas
     */
    public function setHoraInicioActual($horaInicioActual)
    {
        $this->horaInicioActual = $horaInicioActual;

        return $this;
    }

    /**
     * Get horaInicioActual
     *
     * @return \DateTime 
     */
    public function getHoraInicioActual()
    {
        return $this->horaInicioActual;
    }

    /**
     * Set cantidadActPonencias
     *
     * @param integer $cantidadActPonencias
     * @return Salas
     */
    public function setCantidadActPonencias($cantidadActPonencias)
    {
        $this->cantidadActPonencias = $cantidadActPonencias;

        return $this;
    }

    /**
     * Get cantidadActPonencias
     *
     * @return integer 
     */
    public function getCantidadActPonencias()
    {
        return $this->cantidadActPonencias;
    }
}
