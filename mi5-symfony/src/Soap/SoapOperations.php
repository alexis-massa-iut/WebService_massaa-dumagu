<?php

namespace App\Soap;

use App\Entity\Command;
use App\Entity\Product;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

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

    /**
     * Dis "Hello" à la personne passée en paramètre
     * @param string $name Le nom de la personne à qui dire "Hello!"
     * @return string The hello string
     */
    public function sayHello(string $name): string
    {
        return 'Hello ' . $name . '!';
    }

    /**
     * Réalise la somme de deux entiers
     * @param int $a 1er nombre
     * @param int $b 2ème nombre
     * @return int La somme des deux entiers
     */
    public function sumHello(int $a, int $b): int
    {
        return (int)($a + $b);
    }

    /**
     * @param float $a
     * @param float $b
     * @param float $c
     * @return float
     */
    public function sumFloats(float $a, float $b, float $c): float
    {
        return (float)($a + $b + $c);
    }

    /* Comment tester ces méthodes avec SOAP :
        1. Ecrire la méthode souhaitée (ex: getStructureById)
        2. Ajouter un fichier dans le répertoire /soap ou modifier un fichier existant en lien avec l'entité utilisée dans la méthode
        3. Modifier le fichier SecteurStrcutureSoapClient.php dans le répertoire /var/www/html/client_soap_symfony et utiliser la méthode écrite
        4. Démarrer le serveur symfony et aller sur la route http://127.0.0.1:8000/soapgen pour générer le fichier soap.wsdl
        5. Aller sur la route http://localhost/client_soap_symfony/SecteurStructureSoapClient.php pour voir si la méthode à fonctionnée     
    */

    /**
     * Récupère le nom d'un produit avec son id
     * @param Product $prod le produit sans nom
     * @return Product le produit avec son id et son nom
     */
    public function getProductNameById($prod): ?Product
    {
        //Chercher produit par id
        $product = $this->doct->getRepository(Product::class)->find($prod->getId());
        // Si le produit est trouvé, on le récupère son nom dans le produit donné en paramètre
        if ($product != null) {
            $prod->setName($product->getName());
        }
        return $prod;
    }

    /**
     * Récupère les commandes de l'utilisateur avec l'id passé en paramètre
     * @param int L'id de l'utilisateur dont on veut les commandes
     * @return Collection|Command[] Les commandes de l'utilisateur
     */
    public function getUserCommands($user_id): ?Collection
    {
        // Chercher les commandes de l'utilisateur
        $commands = $this->doct->getRepository(Command::class)->findBy(['user' => $user_id]);
        return $commands;
    }

}
