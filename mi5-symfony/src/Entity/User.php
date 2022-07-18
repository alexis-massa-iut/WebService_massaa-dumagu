<?php

/**
 * User.php
 *
 * @author Alexis Massa
 * Created on Sun Jul 17 2022
 **/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * User
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={"email": "partial", "name": "partial", "lastname": "partial"})
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=180, unique=true)
     * @NotNull(message="Email ne doit pas etre null")
     * @Assert\NotBlank(message="Email ne doit pas etre vide")
     */
    private $email;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @NotNull(message="Mot de passe ne doit pas etre null")
     * @Assert\NotBlank(message="Mot de passe ne doit pas etre vide")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @NotNull(message="Prénom ne doit pas etre null")
     * @Assert\NotBlank(message="Prénom ne doit pas etre vide")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @NotNull(message="Nom ne doit pas etre null")
     * @Assert\NotBlank(message="Nom ne doit pas etre vide")
     */
    private $lastname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}
