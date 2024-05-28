<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\EstadoRepository")
 */
class Estado
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
     * @ORM\Column(name="estado", type="string", length=100)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="Ponencias", mappedBy="estado")
     */
    private $ponencias;




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
     * Set estado
     *
     * @param string $estado
     * @return Estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ponencias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ponencias
     *
     * @param \FCOM\IcomBundle\Entity\Ponencias $ponencias
     * @return Estado
     */
    public function addPonencia(\FCOM\IcomBundle\Entity\Ponencias $ponencias)
    {
        $this->ponencias[] = $ponencias;

        return $this;
    }

    /**
     * Remove ponencias
     *
     * @param \FCOM\IcomBundle\Entity\Ponencias $ponencias
     */
    public function removePonencia(\FCOM\IcomBundle\Entity\Ponencias $ponencias)
    {
        $this->ponencias->removeElement($ponencias);
    }

    /**
     * Get ponencias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPonencias()
    {
        return $this->ponencias;
    }
}
