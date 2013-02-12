<?php
// src/Acme/UserBundle/Entity/User.php

namespace Portal\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
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
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your real name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="5", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     *
     * @Assert\MaxLength(limit="150", message="The gravatar email is too long.", groups={"Registration", "Profile"})
     */
    protected $gravatar;
    
    /**
     * @ORM\OneToMany(targetEntity="Portal\AppBundle\Entity\Event", mappedBy="user")
     */
    protected $comments;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;
    
    public function __construct()
    {
        parent::__construct();
    }
    public function setFacebookId($facebook_id)
    {
        $this->facebook_id = $facebook_id;
    }
    public function getFacebookId()
    {
        return $this->facebook_id;
    }
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;
    }
    public function getFaceBookAccessToken()
    {
        return $this->facebook_access_token;
    }
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getGravatar()
    {
        return $this->gravatar;
    }
    
    public function setGravatar($address)
    {
        $this->gravatar = $address;
    }
    
    public function __toString() 
    {
        return $this->id;
    }
}