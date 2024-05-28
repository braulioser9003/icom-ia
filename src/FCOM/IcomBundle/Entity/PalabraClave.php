<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PalabraClave
 *
 * @ORM\Table(name="palabra_clave")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\PalabraClaveRepository")
 */
class PalabraClave
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
     * @ORM\Column(name="palabraClave", type="string", length=100)
     */
    private $palabraClave;

    /**
     * @ORM\ManyToOne(targetEntity="Ponencias", inversedBy="palabraClave")
     * @ORM\JoinColumn(name="ponencias_id", referencedColumnName="id", onDelete="CASCADE")
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
     * Set palabraClave
     *
     * @param string $palabraClave
     * @return PalabraClave
     */
    public function setPalabraClave($palabraClave)
    {
        $this->palabraClave = $palabraClave;

        return $this;
    }

    /**
     * Get palabraClave
     *
     * @return string 
     */
    public function getPalabraClave()
    {
        return $this->palabraClave;
    }

    /**
     * Set ponencias
     *
     * @param \FCOM\IcomBundle\Entity\Ponencias $ponencias
     * @return PalabraClave
     */
    public function setPonencias(\FCOM\IcomBundle\Entity\Ponencias $ponencias = null)
    {
        $this->ponencias = $ponencias;

        return $this;
    }

    /**
     * Get ponencias
     *
     * @return \FCOM\IcomBundle\Entity\Ponencias 
     */
    public function getPonencias()
    {
        return $this->ponencias;
    }
}
