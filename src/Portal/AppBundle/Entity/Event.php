<?php

namespace Portal\AppBundle\Entity;

use Symfomy\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Portal\AppBundle\Repository\EventRepository")
 * @ORM\Table(name="event")
 * @ORM\HasLifecycleCallbacks()
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $shortUrl;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $tags;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $externalUrl;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isPublic;
    
    /**
     * @ORM\ManyToOne(targetEntity="Portal\UserBundle\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
   
    /**
     * @ORM\OneToMany(targetEntity="Highfive", mappedBy="event")
     */
    protected $highfives;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    
    public function __construct()
    {
        $this->highfives = new ArrayCollection();

        $this->shortUrl = base_convert(microtime(true), 10, 36);
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
        $this->setIsPublic(true);
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue()
    {
       $this->setUpdated(new \DateTime());
    }
    
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Generate slugified version of given string
     *
     * @param $text
     * @return mixed|string
     */
    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    /**
     * Create short URL
     */
    public function createShortUrl()
    {
        $this->shortUrl = base_convert(microtime(true), 10, 36);
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
     * Get event's short URL
     *
     * @return string
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        $this->setSlug($this->title);
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->description, 0, $length);
        else
            return $this->description;
    }

    /**
     * Set tags
     *
     * @param text $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Set an external url to an event
     *
     * @param string $externalUrl
     */
    public function setExternalUrl($externalUrl)
    {
        $this->externalUrl = $externalUrl;
    }

    /**
     * Get an external url to an event
     *
     * @return string
     */
    public function getExternalUrl()
    {
        return $this->externalUrl;
    }

    /**
     * Get tags
     *
     * @return text 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set public state
     *
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * Get public state
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }
    
    /**
     * Set public state
     *
     * @param Portal\UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get public state
     *
     * @return Portal\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Get highfives
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHighfives()
    {
        return $this->highfives;
    }
    
    /**
     * Return count of high fives
     * 
     * @return integer 
     */
    public function getCountHighfives()
    {
        return count($this->highfives);
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    

}