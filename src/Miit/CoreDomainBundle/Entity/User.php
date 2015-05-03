<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\User\User as UserModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Util\SecureRandom;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class User
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\UserRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class User extends UserModel implements UserInterface, EquatableInterface
{
    /**
     * {@inheritDoc}
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=255, nullable=false)
     * 
     * @Serializer\Groups({"owner", "list", "details"})
     */
    protected $id;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     * 
     * @Serializer\Groups({"owner"})
     */
    protected $email;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=32, nullable=false)
     * 
     * @Serializer\Groups({"owner", "list", "details"})
     */
    protected $name;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $salt;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="array", nullable=true)
     */
    protected $roles;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="boolean", nullable=false)
     * 
     * @Serializer\Groups({"owner"})
     */
    protected $locked;

    /**
     * {@inheritDoc}
     * 
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="users")
     * @ORM\JoinTable(name="users_teams")
     */
    protected $teams;

    /**
     * {@inheritDoc}
     * 
     * @ORM\ManyToMany(targetEntity="Miit", inversedBy="users")
     * @ORM\JoinTable(name="users_miits")
     */
    protected $miits;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @Serializer\Groups({"owner", "details"})
     */
    protected $registeredAt;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @Serializer\Groups({"owner"})
     */
    protected $updatedAt;

    /**
     * {@inheritDoc}
     */
    public function register($password, $salt = '')
    {
        // Generate a random salt
        $generator = new SecureRandom();
        $salt = bin2hex(
            $generator->nextBytes(32)
        );

        $pass = $this->getEncoder()
                     ->encodePassword($password, $salt);

        parent::register($pass, $salt);
    }

    /**
     * {@inheritDoc}
     */
    public function changePassword($password, $salt = '')
    {   
        // Generate a random salt
        $generator = new SecureRandom();
        $salt = bin2hex(
            $generator->nextBytes(32)
        );

        $pass = $this->getEncoder()
                     ->encodePassword($password, $salt);

        parent::changePassword($pass, $salt);
    }

    /**
     * Generate the encoder for the password
     * 
     * @return PasswordEncoderInterface $encoder
     */
    public function getEncoder()
    {
        return new MessageDigestPasswordEncoder();
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {
        
    }

    /**
     * {@inheritDoc}
     */
    public function isEqualTo(UserInterface $user)
    {
        return $this->email === $user->getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function __construct($id, $name, $email)
    {
        parent::__construct($id, $name, $email);

        $this->teams = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     * 
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("avatar")
     * @Serializer\Groups({"owner", "list", "details"})
     */
    public function getAvatarId()
    {
        return sprintf('http://www.gravatar.com/avatar/%s', parent::getAvatarId());
    }

    /**
     * {@inheritDoc}
     */
    public function addTeam($team)
    {
        if(false === $this->hasTeam($team)) {
            
            // Push the team at the end of the array
            $this->teams->add($team);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removeTeam($team)
    {
        if(true === $this->hasTeam($team)) {

            // Remove it
            $this->teams->removeElement($team);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function hasTeam($team)
    {
        return $this->teams->contains($team);
    }
}