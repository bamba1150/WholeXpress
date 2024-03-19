<?php
// ClientFixtures.php

namespace App\DataFixtures;

use App\Entity\Commercant;
use App\Entity\Particulier;
use App\Repository\ReclamationsRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    // Injection de Dépendance
    private UserRepository $userRepo;
    private ReclamationsRepository $recRepo;

    public function __construct(UserRepository $userRepo, ReclamationsRepository $recRepo)
    {
        $this->userRepo = $userRepo;
        $this->recRepo = $recRepo;
    }

    public function load(ObjectManager $manager): void
    {
        // Rechercher tous les utilisateurs et réclamations
        $users = $this->userRepo->findAll();
        $reclamations = $this->recRepo->findAll();

        // Création de clients Particulier
        for ($i = 1; $i <= 5; $i++) {
            $particulier = new Particulier($this->userRepo, $this->recRepo);
            $particulier->setNomCompletClient("Client Client")
                        ->setEmailClient("client" . $i . "@gmail.com")
                        ->setAdresseClient("adresse");

            // Affecter un utilisateur et une réclamation à un client
            $randomUser = $users[array_rand($users)];
            $randomRec = $reclamations[array_rand($reclamations)];

            $particulier->setCommercial($randomUser)
                        ->setReclamations($randomRec);

            $manager->persist($particulier);
        }

        // Création de clients Commercant
        for ($i = 1; $i <= 5; $i++) {
            $commercant = new Commercant($this->userRepo, $this->recRepo);
            $commercant->setNomCompletClient("Client Client")
                       ->setEmailClient("client" . ($i + 5) . "@gmail.com")
                       ->setAdresseClient("adresse");

            // Affecter un utilisateur et une réclamation à un client
            $randomUser = $users[array_rand($users)];
            $randomRec = $reclamations[array_rand($reclamations)];

            $commercant->setCommercial($randomUser)
                       ->setReclamations($randomRec);

            $manager->persist($commercant);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ReclamationsFixtures::class
        ];
    }
}



