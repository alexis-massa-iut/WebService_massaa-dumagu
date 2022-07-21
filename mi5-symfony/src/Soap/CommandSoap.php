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
    public $id;

    /**
     * @var int id de user
     */
    public $user;

    /**
     * Constructor
     * @param int id de la commande
     * @param int id de user
     */
    public function __construct(int $id_command, int $id_user)
    {
        $this->id_command = $id_command;
        $this->id_user = $id_user;
    }
}
