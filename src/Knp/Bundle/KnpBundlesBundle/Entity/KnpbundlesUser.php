<?php

namespace Knp\Bundle\KnpBundlesBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Knpbunldes user authentificated using OAuth
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="knpbundles_user",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="username",columns={"username"})}
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

    function getRoles()
    {
        return array('ROLE_USER');
    }

    function getPassword()
    {
        return '';
    }

    function getSalt()
    {
        return '';
    }
    

    function eraseCredentials()
    {
    
    }

    function equals(UserInterface $user)
    {
        return (
            $user instanceof User
            && $user->getUsername() === $this->getUsername()
        );
    }
}