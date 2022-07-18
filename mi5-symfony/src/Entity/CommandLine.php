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

/**
 * CommandLine
 * 
 * @ORM\Table(name="command_line")
 * @ORM\Entity
 * @ApiResource
 */
class CommandLine
{

    /**
     * @var \Command
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Command", inversedBy="commandLines")
     * @ORM\JoinColumns(nullable=false)
     * @ApiSubresource
     * @Groups({"command"})
     * @MaxDepth(1)
     */
    private $command;

    /**
     * @var \Product
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource
     * @Groups({"command"})
     * @MaxDepth(1)
     */
    private $product;

    /**
     * @var amount
     * 
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var price
     * 
     * @ORM\Column(name="price", type="float")
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
