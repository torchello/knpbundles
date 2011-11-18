<?php

namespace Knp\Bundle\KnpBundlesBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Knpbunldes user authenticated using OAuth
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="knpbundles_user",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="username",columns={"username", "oAuthProvider"})}
 * )
 */
class KnpbundlesUser implements UserInterface
{
    /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $oAuthProvider;

    public function __toString()
    {
        return $this->username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setOAuthProvider($oAuthProvider)
    {
        $this->oAuthProvider = $oAuthProvider;
    }

    public function getOAuthProvider()
    {
        return $this->oAuthProvider;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getPassword()
    {
        return '';
    }

    public function getSalt()
    {
        return '';
    }
    

    public function eraseCredentials()
    {
    
    }

    public function equals(UserInterface $user)
    {
        return $user instanceof KnpbundlesUser && $user->getUsername() === $this->getUsername();
    }
}