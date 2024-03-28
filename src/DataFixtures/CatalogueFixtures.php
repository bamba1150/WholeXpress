<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CatalogueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Créer trois catalogues avec des références à des clients particuliers
        for ($i = 0; $i < 3; $i++) {
            $catalogue = new Catalogue();
            $catalogue->setLibelleCatalogue($faker->words(3, true));
            $catalogue->setClient($this->getReference('client_' . ($i + 1))); // Utiliser les références des clients
            
            $manager->persist($catalogue);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientFixtures::class
        ];
    }
}


