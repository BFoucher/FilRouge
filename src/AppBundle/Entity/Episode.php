<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Episode
 *
 * @ORM\Table(name="episode")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EpisodeRepository")
 */
class Episode
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="saison", type="integer")
     */
    private $saison;

    /**
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;

    /**
     * @ORM\ManyToOne(targetEntity="Serie",inversedBy="episodes")
     * @var string
     */
    private $serie;

    /**
    * @var string
    *
    * @ORM\ManyToOne(targetEntity="Language")
    */
    private $language;


    /**
    * @var string
    *
    * @ORM\ManyToOne(targetEntity="User",inversedBy="episode")
    */
    private $author;

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
     * Set name
     *
     * @param string $name
     * @return Episode
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Episode
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set saison
     *
     * @param integer $saison
     * @return Episode
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return integer 
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set validated
     *
     * @param boolean $validated
     * @return Episode
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return boolean 
     */
    public function getValidated()
    {
        return $this->validated;
    }

        /**
     * Set serie
     *
     * @param string $serie
     * @return Episode
     */
    public function setserie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getserie()
    {
        return $this->serie;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Episode
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     * @return Episode
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

        public function __toString()
{
    return $this->getName();
}
}
