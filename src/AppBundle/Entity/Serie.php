<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 *
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeriesRepository")
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
    private $thTvdbID;

    /**
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;

    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity= "Episode", mappedBy= "serie", cascade={"remove"})
    */
    private $episodes;

    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity= "Picture", mappedBy= "serie", cascade={"remove"})
    */
    private $picture;

    /**
    * @var string
    *
    * @ORM\ManyToOne(targetEntity="Language",inversedBy="serie")
    */
    private $language;

        /**
    * @var string
    *
    * @ORM\ManyToOne(targetEntity="User",inversedBy="serie")
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
     * @return Series
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
     * @return Series
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
     * @return Series
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
     * @return Series
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
     * Set episodes
     *
     * @param string $episode
     * @return Series
     */
    public function setEpisode($episode)
    {
        $this->episode = $episode;

        return $this;
    }

    /**
     * Get episode
     *
     * @return string 
     */
    public function getEpisode()
    {
        return $this->episode;
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
     * Constructor
     */
    public function __construct()
    {
        $this->episodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->picture = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add picture
     *
     * @param \AppBundle\Entity\Picture $picture
     * @return Serie
     */
    public function addPicture(\AppBundle\Entity\Picture $picture)
    {
        $this->picture[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function removePicture(\AppBundle\Entity\Picture $picture)
    {
        $this->picture->removeElement($picture);
    }

    /**
     * Get picture
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPicture()
    {
        return $this->picture;
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
}
