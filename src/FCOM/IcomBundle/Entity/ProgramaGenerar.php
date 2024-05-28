<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProgramaGenerar
 *
 * @ORM\Table(name="programa_generar")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\ProgramaGenerarRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProgramaGenerar
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
     * @var \string
     * @Assert\NotBlank(message="Se requiere la hora Inicio de la Actividad")
     *
     *
     * @ORM\Column(name="horaInicio", type="string", length=255)
     */
    private $horaInicio;

    /**
     * @var string
     * @Assert\NotBlank(message="Se requiere la hora final de la Actividad")
     *
     *
     * @ORM\Column(name="horaFinal", type="string", length=255)
     */
    private $horaFinal;

    /**
     * @var string
     * @Assert\NotBlank(message="Se requiere la Actividad")
     *
     * @ORM\Column(name="actividad", type="string", length=255)
     */
    private $actividad;

    /**
     * @var string
     * @Assert\NotBlank(message="Se requiere el lugar de la Actividad")
     *
     * @ORM\Column(name="lugar", type="string", length=255)
     */
    private $lugar;

    /**
     * @Assert\NotBlank(message="Se requiere el día de la Actividad")
     * @ORM\ManyToOne(targetEntity="Dia", inversedBy="programaGenerar")
     * @ORM\JoinColumn(name="dia_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $dia;


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
     * Set horaInicio
     *
     * @param string $horaInicio
     * @return ProgramaGenerar
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return string
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinal
     *
     * @param string $horaFinal
     * @return ProgramaGenerar
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return string 
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     * @return ProgramaGenerar
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string 
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return ProgramaGenerar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set dia
     *
     * @param \FCOM\IcomBundle\Entity\Dia $dia
     * @return ProgramaGenerar
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
}
