<?php

namespace Miit\CoreDomainBundle\Entity;

use Miit\CoreDomain\User\User as UserModel;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Class User
 * 
 * @author Tacyniak Boris <boris.tacyniak@itevents.fr>
 * 
 * @ORM\Entity(repositoryClass="Miit\CoreDomainBundle\Repository\UserRepository")
 */
class User extends UserModel implements UserInterface, EquatableInterface
{
    /**
     * {@inheritDoc}
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $id;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    protected $email;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="string", length=32, nullable=false)
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
     */
    protected $locked;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $registeredAt;

    /**
     * {@inheritDoc}
     * 
     * @ORM\Column(type="datetime", nullable=true)
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
}