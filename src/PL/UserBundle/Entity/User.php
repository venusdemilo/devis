<?php

namespace PL\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
    * @var string
    *
    * @ORM\Column(name="rueUser", type="string", length=255, nullable=true)
    */
   private $rueUser;

    /**
     * Set rueUser
     *
     * @param string $rueUser
     *
     * @return User
     */
    public function setRueUser($rueUser)
    {
        $this->rueUser = $rueUser;

        return $this;
    }

    /**
     * Get rueUser
     *
     * @return string
     */
    public function getRueUser()
    {
        return $this->rueUser;
    }
}
