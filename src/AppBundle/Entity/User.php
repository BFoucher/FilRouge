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
     * @ORM\Column(name="fisrtName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var date
     *
     * @ORM\Column(name="birth", type="date")
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Picture", cascade={"all"})
     */
    private $avatar;

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

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serie")
     */
    private $follow;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Episode")
     */
    private $watch;

    public function __construct()
    {
        parent::__construct();
        $this->setBirth(new \DateTime());
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

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birth
     *
     * @param \DateTime $birth
     * @return User
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set avatar
     *
     * @param \AppBundle\Entity\Picture $avatar
     * @return User
     */
    public function setAvatar(\AppBundle\Entity\Picture $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \AppBundle\Entity\Picture
     */
    public function getAvatar()
    {
        // Return an default Picture if not defined
        if ($this->avatar === null){
            return new Picture('imgs/default_avatar.png');
        }
        return $this->avatar;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(){
        return $this->getFirstName().' '.$this->getLastName();
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge(){
        $diff = $this->birth->diff(new \DateTime());
        return $diff->format('%y');
    }

    /**
     * Add follow
     *
     * @param \AppBundle\Entity\Serie $follow
     * @return User
     */
    public function addFollow(\AppBundle\Entity\Serie $follow)
    {
        $this->follow[] = $follow;

        return $this;
    }

    /**
     * Remove follow
     *
     * @param \AppBundle\Entity\Serie $follow
     */
    public function removeFollow(\AppBundle\Entity\Serie $follow)
    {
        $this->follow->removeElement($follow);
    }

    /**
     * Get follow
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollow()
    {
        return $this->follow;
    }

    /**
     * Check if User Follow or Not a Serie
     *
     * @param Serie $serie
     *
     * @return bool
     */
    public function isFollow(Serie $serie){
        if ($this->follow->contains($serie)){
            return true;
        }
        return false;

    }

    /**
     * Add watch
     *
     * @param \AppBundle\Entity\Episode $watch
     * @return User
     */
    public function addWatch(\AppBundle\Entity\Episode $watch)
    {
        $this->watch[] = $watch;

        return $this;
    }

    /**
     * Remove watch
     *
     * @param \AppBundle\Entity\Episode $watch
     */
    public function removeWatch(\AppBundle\Entity\Episode $watch)
    {
        $this->watch->removeElement($watch);
    }

    /**
     * Get watch
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWatch()
    {
        return $this->watch;
    }

    /**
     * Check if User have Watch or Not an Episode
     *
     * @param Episode $episode
     *
     * @return bool
     */
    public function isWatch(\AppBundle\Entity\Episode  $episode){
        if ($this->watch->contains($episode)){
            return true;
        }
        return false;

    }
}
