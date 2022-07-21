<?php

namespace App\Soap;

use App\Entity\Command;
use App\Soap\CommandSoap;
use App\Soap\ProductSoap;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;
use Laminas\Soap\Client\Common;

/**
 * Class SoapOperations
 * @package App\Soap
 */
class SoapOperations
{
    private $doct;

    /**
     * SoapOperations constructor.
     * @param ManagerRegistry $doct
     */
    public function __construct(ManagerRegistry $doct)
    {
        $this->doct = $doct;
    }

    /* Comment tester ces méthodes avec SOAP :
        1. Ecrire la méthode souhaitée (ex: getStructureById)
        2. Ajouter un fichier dans le répertoire /soap ou modifier un fichier existant en lien avec l'entité utilisée dans la méthode
        3. Modifier le fichier SecteurStrcutureSoapClient.php dans le répertoire /var/www/html/client_soap_symfony et utiliser la méthode écrite
        4. Démarrer le serveur symfony et aller sur la route http://127.0.0.1:8000/soapgen pour générer le fichier soap.wsdl
        5. Aller sur la route http://localhost/client_soap_symfony/SecteurStructureSoapClient.php pour voir si la méthode à fonctionnée     
    */

    /**
     * ! Je ne sais pas pourquoi cela ne fonctionne pas, il est impossible d'utiliser getRepository(), sinon erreur :
     * Internal Server Error in C:\wamp64\www\SymfonySoapClient\OperationsSoapClient.php
     * sur la ligne d'appel des fonctions getProductNameById et getUserCommands
     * 
     * Si la fonction ne contient pas d'appel à getRepository(), cela fonctionne correctement
     * Pour le montrer j'ai créé pour chacune des deux fonctions une fonction qui n'utilise pas getRepository(), en mettant des données en dur
     * get_product_name_by_id() et get_user_commands() respectivement
     */

    /**
     * Récupère le nom d'un produit avec son id
     * @param \App\Entity\Product $prod le produit sans nom
     * @return object le produit avec son id et son nom
     */
    public function getProductNameById($prod): ?object
    {
        // Chercher produit par id
        $product = $this->doct->getRepository(Product::class)->findOneBy(['id' => $prod->id]);
        // Si le produit est trouvé, on le récupère son nom dans le produit donné en paramètre
        if ($product != null) {
            $prod->name = $product->name;
        }
        return $prod;
    }

    /**
     * Récupère le nom d'un produit avec son id SANS UTILISER GETREPOSITORY()
     * @param \App\Entity\Product $prod le produit sans nom
     * @return object le produit avec son id et son nom
     */
    public function get_product_name_by_id($prod): ?object
    {
        // Chercher produit par id
        $prod->name = "Nom en dur";
        return $prod;
    }

    /**
     * Récupère les commandes de l'utilisateur avec l'id passé en paramètre
     * @param int L'id de l'utilisateur dont on veut les commandes
     * @return array Les commandes de l'utilisateur
     */
    public function getUserCommands($user_id): ?array
    {
        // Chercher les commandes de l'utilisateur avec filtre sur l'id user
        $commands = $this->doct->getRepository(Command::class)->findBy(['user' => $user_id]);
        return $commands;
    }

    /**
     * Récupère les commandes de l'utilisateur avec l'id passé en paramètre
     * @param int L'id de l'utilisateur dont on veut les commandes
     * @return array Les commandes de l'utilisateur
     */
    public function get_user_commands($user_id): ?array
    {
        // Chercher les commandes de l'utilisateur
        $commands = [
            new CommandSoap(1, 1),
            new CommandSoap(2, 23),
            new CommandSoap(3, 4),
            new CommandSoap(4, 13),
            new CommandSoap(5, 4)
        ];
        $toReturn = [];
        // filtre sur id user
        foreach ($commands as $key => $value) {
            if($value->id_user == $user_id)
                $toReturn[] = $value;
        }
        return $toReturn;
    }
}
