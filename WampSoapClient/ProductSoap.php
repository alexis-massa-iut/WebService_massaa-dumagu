<?php

namespace App\Soap;

/**
 * Class Product minimaliste pour test client Soap
 */
class ProductSoap
{

    /**
     * @var int id du produit
     */
    public $id;

    /**
     * @var string nom du produit
     */
    public $name;

    /**
     * Constructor
     * @param int id du produit
     * @param string nom du produit
     */
    public function __construct(int $id_prod, string $name)
    {
        $this->id_prod = $id_prod;
        $this->name = $name;
    }
}
