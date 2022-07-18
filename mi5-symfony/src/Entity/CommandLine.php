<?php

/**
 * CommandLine.php
 *
 * @author Alexis Massa
 * Created on Sun Jul 17 2022
 **/

namespace App\Entity;

use App\Repository\CommandLineRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints\NotNull;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * CommandLine
 * 
 * @ORM\Entity(repositoryClass=CommandLinerepository::class)
 * @ApiResource(normalizationContext={"groups"={"commandLine"},"enable_max_depth"=true})
 */
class CommandLine
{

    /**
     * @var \Command
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Command::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource
     * @Groups({"product","commandLine"})
     * @MaxDepth(1)
     */
    private $command;

    /**
     * @var \Product
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource
     * @Groups({"command","commandLine"})
     * @MaxDepth(1)
     */
    private $product;

    /**
     * @var amount
     * 
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @var price
     * 
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
