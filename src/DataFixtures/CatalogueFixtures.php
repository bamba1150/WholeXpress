<?php
// CatalogueFixtures.php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Repository\ClientRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CatalogueFixtures extends Fixture
{
    private ClientRepository $clientRepository;
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
    public function load(ObjectManager $manager): void
    {
        $clients = $this->clientRepository->findAll();

        // Vérifier si le tableau $clients est vide
        if (empty($clients)) {
            // Générer une erreur ou prendre une mesure alternative, comme ne pas créer de catalogues
            throw new \RuntimeException("Aucun client trouvé dans la base de données.");
        }
        // Création de 3 catalogues fictifs avec des libellés statiques
        for ($i = 1; $i <= 3; $i++) {
            $catalogue = new Catalogue();
            $catalogue->setLibelleCatalogue("Catalogue " . $i);
            
            // Associer le catalogue a un client existant
            $randomClient = $clients[array_rand($clients)];
            $catalogue -> setClient($randomClient);

            $manager->persist($catalogue);
        }

        $manager->flush();
    }
}
