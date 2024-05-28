<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Receso
 *
 * @ORM\Table(name="receso")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\RecesoRepository")
 */
class Receso
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
     * @ORM\ManyToOne(targetEntity="intervalo", inversedBy="receso")
     * @ORM\JoinColumn(name="intervalo_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $intervalo;


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
     * @param \DateTime $horaInicio
     * @return Receso
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
     * @return Receso
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
     * Set intervalo
     *
     * @param \FCOM\IcomBundle\Entity\intervalo $intervalo
     * @return Receso
     */
    public function setIntervalo(\FCOM\IcomBundle\Entity\intervalo $intervalo = null)
    {
        $this->intervalo = $intervalo;

        return $this;
    }

    /**
     * Get intervalo
     *
     * @return \FCOM\IcomBundle\Entity\intervalo 
     */
    public function getIntervalo()
    {
        return $this->intervalo;
    }
}
