<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity= "Episode", mappedBy= "author", cascade={"remove"})
    */
    private $episode;


    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity= "Serie", mappedBy= "author", cascade={"remove"})
    */
    private $serie;


    public function __construct()
    {
        parent::__construct();
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
     * Set episode
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
     * Add episode
     *
     * @param \AppBundle\Entity\Episode $episode
     * @return User
     */
    public function addEpisode(\AppBundle\Entity\Episode $episode)
    {
        $this->episode[] = $episode;

        return $this;
    }

    /**
     * Remove episode
     *
     * @param \AppBundle\Entity\Episode $episode
     */
    public function removeEpisode(\AppBundle\Entity\Episode $episode)
    {
        $this->episode->removeElement($episode);
    }

    /**
     * Add serie
     *
     * @param \AppBundle\Entity\Serie $serie
     * @return User
     */
    public function addSerie(\AppBundle\Entity\Serie $serie)
    {
        $this->serie[] = $serie;

        return $this;
    }

    /**
     * Remove serie
     *
     * @param \AppBundle\Entity\Serie $serie
     */
    public function removeSerie(\AppBundle\Entity\Serie $serie)
    {
        $this->serie->removeElement($serie);
    }
}
