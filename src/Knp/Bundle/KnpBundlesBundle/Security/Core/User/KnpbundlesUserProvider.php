<?php

namespace Knp\Bundle\KnpBundlesBundle\Security\Core\User;

use Knp\Bundle\KnpBundlesBundle\Entity\KnpbundlesUser;

use Symfony\Component\HttpKernel\KernelInterface,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * A User provider which is using together with OAuth bundle to create new
 * DB users and get existing users
 */
class KnpbundlesUserProvider implements UserProviderInterface
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->em->getRepository('KnpBundlesBundle:KnpbundlesUser')->findOneByUsername($username);

        if (!$user) {
            $user = new KnpbundlesUser();
            $user->setUsername($username);
            $user->setOAuthProvider('github'); //TODO/discuss: how we can define OAuthProvider?
            
            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $user = $this->loadUserByUsername($user->getUsername());
        
        return $user;
    }

    public function supportsClass($class)
    {
        return $class === 'Knp\Bundle\KnpBundlesBundle\Entity\KnpbundlesUser';
    }
}