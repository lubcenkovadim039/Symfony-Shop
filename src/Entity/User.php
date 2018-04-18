<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $lastName;

    /**
     * @var bool
     * @Assert\NotBlank(groups={"Registration"})
     */
    private $acceptRules;

    public function __construct()
    {
        parent::__construct();

        $this->username = '';
        $this->password = '';
        $this->email = '';
        $this->firstName = '';
        $this->lastName = '';
        $this->roles = ['ROLE_USER'];
        $this->acceptRules = false;
    }


    public function getId()
    {
        return $this->id;
    }


    /**
     * @return bool
     */
    public function isAcceptRules(): bool
    {
        return $this->acceptRules;
    }

    /**
     * @param bool $acceptRules
     */
    public function setAcceptRules(bool $acceptRules): void
    {
        $this->acceptRules = $acceptRules;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }


}
