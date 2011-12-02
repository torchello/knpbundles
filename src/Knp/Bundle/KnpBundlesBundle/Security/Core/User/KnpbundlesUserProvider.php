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
    protected $container;

    public function __construct($em, $updater)
    {
        $this->em = $em;
        $this->updater = $updater;
    }

    public function loadUserByUsername($username)
    {
        $knpBundlesUser = $this->em->getRepository('KnpBundlesBundle:KnpbundlesUser')->findOneByUsername($username);

        if (!$knpBundlesUser) {
            $knpBundlesUser = new KnpbundlesUser();
            $knpBundlesUser->setUsername($username);
            $knpBundlesUser->setOAuthProvider('github');
            
            // Get GitHub user
            $user = $this->updater->getOrCreateUser($username);
            $knpBundlesUser->setUser($user);

            $this->em->persist($knpBundlesUser);
            $this->em->flush();
        }

        return $knpBundlesUser;
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