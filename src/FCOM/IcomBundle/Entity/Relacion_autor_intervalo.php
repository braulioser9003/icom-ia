<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relacion_autor_intervalo
 *
 * @ORM\Table(name="relacion_autor_intervalo")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\Relacion_autor_intervaloRepository")
 */
class Relacion_autor_intervalo
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
     * @ORM\Column(name="id_intervalo", type="integer")
     */
    private $idIntervalo;

    /**
     * @var int
     *
     * @ORM\Column(name="id_autor", type="integer")
     */
    private $idAutor;

    /**
     * @var int
     *
     * @ORM\Column(name="id_intervalo_relacion", type="integer")
     */
    private $idIntervaloRelacion;


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
     * Set idIntervalo
     *
     * @param integer $idIntervalo
     * @return Relacion_autor_intervalo
     */
    public function setIdIntervalo($idIntervalo)
    {
        $this->idIntervalo = $idIntervalo;

        return $this;
    }

    /**
     * Get idIntervalo
     *
     * @return integer 
     */
    public function getIdIntervalo()
    {
        return $this->idIntervalo;
    }

    /**
     * Set idAutor
     *
     * @param integer $idAutor
     * @return Relacion_autor_intervalo
     */
    public function setIdAutor($idAutor)
    {
        $this->idAutor = $idAutor;

        return $this;
    }

    /**
     * Get idAutor
     *
     * @return integer 
     */
    public function getIdAutor()
    {
        return $this->idAutor;
    }

    /**
     * Set idIntervaloRelacion
     *
     * @param integer $idIntervaloRelacion
     * @return Relacion_autor_intervalo
     */
    public function setIdIntervaloRelacion($idIntervaloRelacion)
    {
        $this->idIntervaloRelacion = $idIntervaloRelacion;

        return $this;
    }

    /**
     * Get idIntervaloRelacion
     *
     * @return integer 
     */
    public function getIdIntervaloRelacion()
    {
        return $this->idIntervaloRelacion;
    }
}
