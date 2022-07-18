<?php

/**
 * Command.php
 *
 * @author Alexis Massa
 * Created on Sun Jul 17 2022
 **/

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotNull;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * Command
 *
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 * @ApiResource(normalizationContext={"groups"={"command"},"enable_max_depth"=true})
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(RangeFilter::class, properties={"date"})
 * @ApiFilter(SearchFilter::class, properties={"status": "exact"})
 */
class Command
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"product","command","commandLine"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @NotNull(message="Date ne doit pas etre null")
     * @Assert\NotBlank(message="Date ne doit pas etre vide")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @NotNull(message="Statut ne doit pas etre null")
     * @Assert\NotBlank(message="Statut ne doit pas etre vide")
     * @Groups({"product","command","commandLine"})
     */
    private $status;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commands")
     * @ORM\JoinColumn(nullable=false)
     * @NotNull(message="User ne doit pas etre null")
     * @Assert\NotBlank(message="User ne doit pas etre vide.")
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity=CommandLine::class, mappedBy="command", orphanRemoval=true)
     * @Groups({"command"})
     * @MaxDepth(1)
     */
    private $commandLines;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandLines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CommandLine[]
     */
    public function getCommandLines(): Collection
    {
        return $this->commandLines;
    }

    public function addCommandLine(CommandLine $commandLine): self
    {
        if (!$this->commandLines->contains($commandLine)) {
            $this->commandLines[] = $commandLine;
            $commandLine->setCommand($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): self
    {
        if ($this->commandLines->removeElement($commandLine)) {
            // set the owning side to null (unless already changed)
            if ($commandLine->getCommand() === $this) {
                $commandLine->setCommand(null);
            }
        }

        return $this;
    }
}
