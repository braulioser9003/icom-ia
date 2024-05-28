<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Combinacion
 *
 * @ORM\Table(name="combinacion")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\CombinacionRepository")
 */
class Combinacion
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
     * @ORM\Column(name="idPrimero", type="integer")
     */
    private $idPrimero;

    /**
     * @var int
     *
     * @ORM\Column(name="idSegundo", type="integer")
     */
    private $idSegundo;

    /**
     * @var int
     *
     * @ORM\Column(name="idTercero", type="integer")
     */
    private $idTercero;

    /**
     * @var int
     *
     * @ORM\Column(name="mitad", type="integer")
     */
    private $mitad;

    /**
     * @var float
     *
     * @ORM\Column(name="porciento", type="float")
     */
    private $porciento;

    /**
     * @var int
     *
     * @ORM\Column(name="totalMinutos", type="integer")
     */
    private $totalMinutos;

    /**
     * @ORM\ManyToOne(targetEntity="Salas", inversedBy="combinacion")
     * @ORM\JoinColumn(name="sala_id", referencedColumnName="id", onDelete="CASCADE")
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
     * Set idPrimero
     *
     * @param integer $idPrimero
     * @return Combinacion
     */
    public function setIdPrimero($idPrimero)
    {
        $this->idPrimero = $idPrimero;

        return $this;
    }

    /**
     * Get idPrimero
     *
     * @return integer 
     */
    public function getIdPrimero()
    {
        return $this->idPrimero;
    }

    /**
     * Set idSegundo
     *
     * @param integer $idSegundo
     * @return Combinacion
     */
    public function setIdSegundo($idSegundo)
    {
        $this->idSegundo = $idSegundo;

        return $this;
    }

    /**
     * Get idSegundo
     *
     * @return integer 
     */
    public function getIdSegundo()
    {
        return $this->idSegundo;
    }

    /**
     * Set idTercero
     *
     * @param integer $idTercero
     * @return Combinacion
     */
    public function setIdTercero($idTercero)
    {
        $this->idTercero = $idTercero;

        return $this;
    }

    /**
     * Get idTercero
     *
     * @return integer 
     */
    public function getIdTercero()
    {
        return $this->idTercero;
    }

    /**
     * Set mitad
     *
     * @param integer $mitad
     * @return Combinacion
     */
    public function setMitad($mitad)
    {
        $this->mitad = $mitad;

        return $this;
    }

    /**
     * Get mitad
     *
     * @return integer 
     */
    public function getMitad()
    {
        return $this->mitad;
    }

    /**
     * Set porciento
     *
     * @param float $porciento
     * @return Combinacion
     */
    public function setPorciento($porciento)
    {
        $this->porciento = $porciento;

        return $this;
    }

    /**
     * Get porciento
     *
     * @return float 
     */
    public function getPorciento()
    {
        return $this->porciento;
    }

    /**
     * Set totalMinutos
     *
     * @param integer $totalMinutos
     * @return Combinacion
     */
    public function setTotalMinutos($totalMinutos)
    {
        $this->totalMinutos = $totalMinutos;

        return $this;
    }

    /**
     * Get totalMinutos
     *
     * @return integer 
     */
    public function getTotalMinutos()
    {
        return $this->totalMinutos;
    }

    /**
     * Set salas
     *
     * @param \FCOM\IcomBundle\Entity\Salas $salas
     * @return Combinacion
     */
    public function setSalas(\FCOM\IcomBundle\Entity\Salas $salas = null)
    {
        $this->salas = $salas;

        return $this;
    }

    /**
     * Get salas
     *
     * @return \FCOM\IcomBundle\Entity\Salas 
     */
    public function getSalas()
    {
        return $this->salas;
    }
}
