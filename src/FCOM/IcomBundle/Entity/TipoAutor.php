<?php

namespace FCOM\IcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoAutor
 *
 * @ORM\Table(name="tipo_autor")
 * @ORM\Entity(repositoryClass="FCOM\IcomBundle\Repository\TipoAutorRepository")
 */
class TipoAutor
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
     * @ORM\Column(name="tipoAutor", type="string", length=100)
     */
    private $tipoAutor;

    /**
     * @ORM\OneToMany(targetEntity="Autor", mappedBy="tipoAutor")
     */
    private $autor;

    public function __construct()
    {
        $this->autor = new ArrayCollection();
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
     * Set tipoAutor
     *
     * @param string $tipoAutor
     * @return TipoAutor
     */
    public function setTipoAutor($tipoAutor)
    {
        $this->tipoAutor = $tipoAutor;

        return $this;
    }

    /**
     * Get tipoAutor
     *
     * @return string 
     */
    public function getTipoAutor()
    {
        return $this->tipoAutor;
    }

    /**
     * Add autor
     *
     * @param \FCOM\IcomBundle\Entity\Autor $autor
     * @return TipoAutor
     */
    public function addAutor(\FCOM\IcomBundle\Entity\Autor $autor)
    {
        $this->autor[] = $autor;

        return $this;
    }

    /**
     * Remove autor
     *
     * @param \FCOM\IcomBundle\Entity\Autor $autor
     */
    public function removeAutor(\FCOM\IcomBundle\Entity\Autor $autor)
    {
        $this->autor->removeElement($autor);
    }

    /**
     * Get autor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutor()
    {
        return $this->autor;
    }
}
