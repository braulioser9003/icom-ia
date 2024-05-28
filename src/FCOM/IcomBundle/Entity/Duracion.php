<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Duracion
 *
 * @ORM\Table(name="duracion")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\DuracionRepository")
 */
class Duracion
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
     * @var int
     *
     * @ORM\Column(name="expPonencias", type="integer")
     */
    private $expPonencias;

    /**
     * @var int
     *
     * @ORM\Column(name="pregPonencias", type="integer")
     */
    private $pregPonencias;

    /**
     * @var int
     *
     * @ORM\Column(name="debate", type="integer")
     */
    private $debate;

    /**
     * @var int
     *
     * @ORM\Column(name="receso", type="integer")
     */
    private $receso;

    /**
     * @var int
     *
     * @ORM\Column(name="intermedio", type="integer")
     */
    private $intermedio;

    /**
     * @var
     *
     * @ORM\Column(name="cantPoster", type="integer")
     */
    private $cantPoster;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaCambio", type="time")
     */
    private $horaCambio;


    /**
     * @ORM\OneToMany(targetEntity="Salas", mappedBy="duracion")
     */
    private $salas;


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
     * Set expPonencias
     *
     * @param integer $expPonencias
     * @return Duracion
     */
    public function setExpPonencias($expPonencias)
    {
        $this->expPonencias = $expPonencias;

        return $this;
    }

    /**
     * Get expPonencias
     *
     * @return integer 
     */
    public function getExpPonencias()
    {
        return $this->expPonencias;
    }

    /**
     * Set pregPonencias
     *
     * @param integer $pregPonencias
     * @return Duracion
     */
    public function setPregPonencias($pregPonencias)
    {
        $this->pregPonencias = $pregPonencias;

        return $this;
    }

    /**
     * Get pregPonencias
     *
     * @return integer 
     */
    public function getPregPonencias()
    {
        return $this->pregPonencias;
    }

    /**
     * Set debate
     *
     * @param integer $debate
     * @return Duracion
     */
    public function setDebate($debate)
    {
        $this->debate = $debate;

        return $this;
    }

    /**
     * Get debate
     *
     * @return integer 
     */
    public function getDebate()
    {
        return $this->debate;
    }

    /**
     * Set receso
     *
     * @param integer $receso
     * @return Duracion
     */
    public function setReceso($receso)
    {
        $this->receso = $receso;

        return $this;
    }

    /**
     * Get receso
     *
     * @return integer 
     */
    public function getReceso()
    {
        return $this->receso;
    }

    /**
     * Set intermedio
     *
     * @param integer $intermedio
     * @return Duracion
     */
    public function setIntermedio($intermedio)
    {
        $this->intermedio = $intermedio;

        return $this;
    }

    /**
     * Get intermedio
     *
     * @return integer 
     */
    public function getIntermedio()
    {
        return $this->intermedio;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add salas
     *
     * @param \FCOM\IcomBundle\Entity\Salas $salas
     * @return Duracion
     */
    public function addSala(\FCOM\IcomBundle\Entity\Salas $salas)
    {
        $this->salas[] = $salas;

        return $this;
    }

    /**
     * Remove salas
     *
     * @param \FCOM\IcomBundle\Entity\Salas $salas
     */
    public function removeSala(\FCOM\IcomBundle\Entity\Salas $salas)
    {
        $this->salas->removeElement($salas);
    }

    /**
     * Get salas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalas()
    {
        return $this->salas;
    }

    /**
     * Set cantPoster
     *
     * @param integer $cantPoster
     * @return Duracion
     */
    public function setCantPoster($cantPoster)
    {
        $this->cantPoster = $cantPoster;

        return $this;
    }

    /**
     * Get cantPoster
     *
     * @return integer 
     */
    public function getCantPoster()
    {
        return $this->cantPoster;
    }

    /**
     * Set horaCambio
     *
     * @param \DateTime $horaCambio
     * @return Duracion
     */
    public function setHoraCambio($horaCambio)
    {
        $this->horaCambio = $horaCambio;

        return $this;
    }

    /**
     * Get horaCambio
     *
     * @return \DateTime 
     */
    public function getHoraCambio()
    {
        return $this->horaCambio->format('h:i:s');
    }
}
