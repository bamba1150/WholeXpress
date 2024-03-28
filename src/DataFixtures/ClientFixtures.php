<?php

// src/DataFixtures/ClientFixtures.php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Commercant;
use App\Entity\Particulier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Créer trois clients particuliers
        for ($i = 0; $i < 3; $i++) {
            $particulier = new Particulier();
            $particulier->setEmailClient($faker->email);
            $particulier->setAdresseClient($faker->address);
            $particulier->setNomCompletClient($faker->name);
            $particulier->setCodeClient('PART00' . ($i + 1)); // Générer un code de client
            $particulier->setCommercial($this->getReference('user_' . ($i + 1))); // Supposant que vous avez des références utilisateur
           
            $manager->persist($particulier);
            $this->addReference('client_' . ($i + 1), $particulier); // Ajouter une référence
        }

        // Créer trois clients commerçants
        for ($i = 0; $i < 3; $i++) {
            $commercant = new Commercant();
            $commercant->setEmailClient($faker->email);
            $commercant->setAdresseClient($faker->address);
            $commercant->setNomCompletClient($faker->name);
            $commercant->setCodeClient('COM00' . ($i + 1)); // Générer un code de client
            $commercant->setCommercial($this->getReference('user_' . ($i + 3))); // Supposant que vous avez des références utilisateur pour les commerçants
            
            $manager->persist($commercant);
            $this->addReference('client_' . ($i + 4), $commercant); // Ajouter une référence pour les commerçants
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}

