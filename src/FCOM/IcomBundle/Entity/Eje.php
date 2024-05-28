<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eje
 *
 * @ORM\Table(name="eje")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\EjeRepository")
 */
class Eje
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
     * @ORM\Column(name="eje", type="string", length=255)
     */
    private $eje;

    /**
     * @var string
     *
     * @ORM\Column(name="nabreviatura", type="string", length=255)
     */
    private $nabreviatura;

    /**
     * @ORM\ManyToMany(targetEntity="intervalo", cascade={"persist"})
     * @ORM\JoinTable(name="intervalo_eje",
     *      joinColumns={@ORM\JoinColumn(name="eje_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="intervalo_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    private $intervalo;

    /**
     * @ORM\OneToMany(targetEntity="Tematica", mappedBy="eje")
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
     * Set eje
     *
     * @param string $eje
     * @return Eje
     */
    public function setEje($eje)
    {
        $this->eje = $eje;

        return $this;
    }

    /**
     * Get eje
     *
     * @return string 
     */
    public function getEje()
    {
        return $this->eje;
    }

    /**
     * Set nabreviatura
     *
     * @param string $nabreviatura
     * @return Eje
     */
    public function setNabreviatura($nabreviatura)
    {
        $this->nabreviatura = $nabreviatura;

        return $this;
    }

    /**
     * Get nabreviatura
     *
     * @return string 
     */
    public function getNabreviatura()
    {
        return $this->nabreviatura;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->intervalo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add intervalo
     *
     * @param \FCOM\IcomBundle\Entity\intervalo $intervalo
     * @return Eje
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
     * Add tematica
     *
     * @param \FCOM\IcomBundle\Entity\Tematica $tematica
     * @return Eje
     */
    public function addTematica(\FCOM\IcomBundle\Entity\Tematica $tematica)
    {
        $this->tematica[] = $tematica;

        return $this;
    }

    /**
     * Remove tematica
     *
     * @param \FCOM\IcomBundle\Entity\Tematica $tematica
     */
    public function removeTematica(\FCOM\IcomBundle\Entity\Tematica $tematica)
    {
        $this->tematica->removeElement($tematica);
    }

    /**
     * Get tematica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTematica()
    {
        return $this->tematica;
    }
}
