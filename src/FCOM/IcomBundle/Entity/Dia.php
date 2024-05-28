<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Input\StringInput;

/**
 * Dia
 *
 * @ORM\Table(name="dia")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\DiaRepository")
 */
class Dia
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
     * @ORM\Column(name="dia", type="date")
     */
    private $dia;

    /**
     * @ORM\OneToMany(targetEntity="Salas", mappedBy="dia")
     */
    private $salas;

    /**
     * @ORM\OneToMany(targetEntity="ProgramaGenerar", mappedBy="dia")
     */
    private $programaGenerar;


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
     * Set dia
     *
     * @param \DateTime $dia
     * @return Dia
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return \DateTime 
     */
    public function getDia()
    {
        return $this->dia->format('d.m.y');
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add salas
     *
     * @param \FCOM\IcomBundle\Entity\Salas $salas
     * @return Dia
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
    public function removeSla(\FCOM\IcomBundle\Entity\Salas $salas)
    {
        $this->salas->removeElement($salas);
    }

    /**
     * Get slas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalas()
    {
        return $this->salas;
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
     * Add programaGenerar
     *
     * @param \FCOM\IcomBundle\Entity\ProgramaGenerar $programaGenerar
     * @return Dia
     */
    public function addProgramaGenerar(\FCOM\IcomBundle\Entity\ProgramaGenerar $programaGenerar)
    {
        $this->programaGenerar[] = $programaGenerar;

        return $this;
    }

    /**
     * Remove programaGenerar
     *
     * @param \FCOM\IcomBundle\Entity\ProgramaGenerar $programaGenerar
     */
    public function removeProgramaGenerar(\FCOM\IcomBundle\Entity\ProgramaGenerar $programaGenerar)
    {
        $this->programaGenerar->removeElement($programaGenerar);
    }

    /**
     * Get programaGenerar
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgramaGenerar()
    {
        return $this->programaGenerar;
    }
}
