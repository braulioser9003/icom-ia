<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\UniqueEntity;

/**
 * Etiqueta
 *
 * @ORM\Table(name="etiqueta")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\EtiquetaRepository")
 */
class Etiqueta
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
     * @ORM\Column(name="etiqueta", type="string", length=150)
     */
    private $etiqueta;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Noticias", mappedBy="etiqueta")
     */
    private $noticias;
    
    public function __construct()
    {
        $this->noticias = new ArrayCollection();
        
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
     * Set etiqueta
     *
     * @param string $etiqueta
     * @return Etiqueta
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string 
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Add noticias
     *
     * @param \FCOM\IcomBundle\Entity\Noticias $noticias
     * @return Etiqueta
     */
    public function addNoticia(\FCOM\IcomBundle\Entity\Noticias $noticias)
    {
        $this->noticias[] = $noticias;

        return $this;
    }

    /**
     * Remove noticias
     *
     * @param \FCOM\IcomBundle\Entity\Noticias $noticias
     */
    public function removeNoticia(\FCOM\IcomBundle\Entity\Noticias $noticias)
    {
        $this->noticias->removeElement($noticias);
    }

    /**
     * Get noticias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticias()
    {
        return $this->noticias;
    }
}
