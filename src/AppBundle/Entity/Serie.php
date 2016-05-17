<?php

namespace AppBundle\Entity;

use AppBundle\Form\PictureType;
use Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 *
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SerieRepository")
 */
class Serie
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
     * @ORM\Column(name="thTvdbID", type="integer")
     */
    private $thTvdbID=0;

    /**
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated=0;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity= "Episode", mappedBy= "serie", cascade={"remove"})
     */
    private $episodes;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity= "Picture", cascade={"all"})
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Language")
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="User",inversedBy="serie")
     */
    private $author;

    /**
     * @var int
     *
     * @ORM\Column(name="parent", type="integer")
     */
    private $parent=0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->episodes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Serie
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
     * @return Serie
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
     * Set thTvdbID
     *
     * @param integer $thTvdbID
     * @return Serie
     */
    public function setThTvdbID($thTvdbID)
    {
        $this->thTvdbID = $thTvdbID;

        return $this;
    }

    /**
     * Get thTvdbID
     *
     * @return integer
     */
    public function getThTvdbID()
    {
        return $this->thTvdbID;
    }

    /**
     * Set validated
     *
     * @param boolean $validated
     * @return Serie
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
     * Add episodes
     *
     * @param \AppBundle\Entity\Episode $episodes
     * @return Serie
     */
    public function addEpisode(\AppBundle\Entity\Episode $episodes)
    {
        $this->episodes[] = $episodes;

        return $this;
    }

    /**
     * Remove episodes
     *
     * @param \AppBundle\Entity\Episode $episodes
     */
    public function removeEpisode(\AppBundle\Entity\Episode $episodes)
    {
        $this->episodes->removeElement($episodes);
    }

    /**
     * Get episodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * Set picture
     *
     * @param \AppBundle\Entity\Picture $picture
     * @return Serie
     */
    public function setPicture(\AppBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \AppBundle\Entity\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Language $language
     * @return Serie
     */
    public function setLanguage(\AppBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     * @return Serie
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

    public function setId($id){
        $this->id = $id;
    }
    public function __clone() {
        $this->id = null;
        $this->episodes = null;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set parent
     *
     * @param integer $parent
     * @return Serie
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
