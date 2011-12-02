<?php

namespace Knp\Bundle\KnpBundlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A link to bundle manuals and how-to
 *
 * @ORM\Entity()
 * @ORM\Table(
 *      name="link"
 * )
 */
class Link
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Link title
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * Link url
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $url;

    /**
     * Bundle the link is for
     *
     * @ORM\ManyToOne(targetEntity="Bundle", inversedBy="links")
     * @ORM\JoinColumn(name="bundle_id", referencedColumnName="id", nullable=false)
     */
    protected $bundle;

    /**
    * User which added the link
    *
    * @ORM\ManyToOne(targetEntity="KnpbundlesUser", inversedBy="links")
    * @ORM\JoinColumn(name="knpbundles_user_id", referencedColumnName="id", nullable=false)
    */
    protected $knpbundlesUser;

    public function __construct($url, $knpbundlesUser, $title = null)
    {
        $this->url = $url;
        $this->title = $title;
        $this->knpbundlesUser = $knpbundlesUser;
    }

    /**
     * Get the link title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
    * Set link title
    *
    * @param  string
    * @return null
    */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
    * Get the link url
    *
    * @return string
    */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Set link url
     *
     * @param  string
     * @return null
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getBundle()
    {
        return $this->bundle;
    }
    
    public function setBundle(Bundle $bundle)
    {
        $this->bundle = $bundle;
    }

    public function getKnpbundlesUser()
    {
        return $this->knpbundlesUser;
    }

    public function setKnpbundlesUser(KnpbundlesUser $knpbundlesUser)
    {
        $this->knpbundlesUser = $knpbundlesUser;
    }
}
