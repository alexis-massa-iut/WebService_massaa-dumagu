<?php

namespace App\Soap;

/**
 * Class Command minimaliste pour test client Soap
 */
class CommandSoap
{

    /**
     * @var int id de la commande
     */
    private $id;

    /**
     * @var int id de user
     */
    private $user;

    /**
     * Constructor
     * @param int id de la commande
     * @param int id de user
     */
    public function __construct(int $id_command, int $id_user)
    {
        $this->id_command = $id_command;
        $this->user = $id_user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): int
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;
        return $this;
    }
}
