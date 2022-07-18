<?php

/**
 * Product.php
 *
 * @author Alexis Massa
 * Created on Sun Jul 17 2022
 **/


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotNull;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(normalizationContext={"groups"={"product"},"enable_max_depth"=true})
 * @ApiFilter(RangeFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={"name": "partial","text":"partial","price": "exact"})
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"product","command","commandLine"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @NotNull(message="Nom ne doit pas etre null")
     * @Assert\NotBlank(message="Nom ne doit pas etre vide")
     * @Groups({"product","command","commandLine"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @NotNull(message="Image ne doit pas etre null")
     * @Assert\NotBlank(message="Image ne doit pas etre vide")
     * @Groups({"product","command","commandLine"})
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=0)
     * @NotNull(message="Texte ne doit pas etre null")
     * @Assert\NotBlank(message="Texte ne doit pas etre vide")
     * @Groups({"product","command","commandLine"})
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @NotNull(message="Prix ne doit pas etre null")
     * @Assert\NotBlank(message="Prix ne doit pas etre vide")
     * @Groups({"product","command","commandLine"})
     */
    private $price;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Groups({"product","command","commandLine"})
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity=Command::class, mappedBy="product", orphanRemoval=true)
     * @Groups({"product","command","commandLine"})
     */
    private $command;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->command = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Command>
     */
    public function getCommand(): Collection
    {
        return $this->command;
    }

    public function addCommand(Command $command): self
    {
        if (!$this->command->contains($command)) {
            $this->command[] = $command;
            $command->addProduct($this);
        }

        return $this;
    }

    public function removeCommand(Command $command): self
    {
        if ($this->command->removeElement($command)) {
            $command->removeProduct($this);
        }

        return $this;
    }
}
