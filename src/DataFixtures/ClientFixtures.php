<?php

namespace App\DataFixtures;
// ...

use App\Entity\Particulier;
use App\Entity\Commercant;
use App\Repository\ReclamationsRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    private UserRepository $userRepo;
    private ReclamationsRepository $recRepo;

    public function __construct(UserRepository $userRepo, ReclamationsRepository $recRepo)
    {
        $this->userRepo = $userRepo;
        $this->recRepo = $recRepo;
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->userRepo->findAll();
        $reclamations = $this->recRepo->findAll();

        for ($i = 1; $i <= 5; $i++) {
            $particulier = new Particulier();
            $particulier->setNomCompletClient("Client Client")
                ->setEmailClient("client" . $i . "@gmail.com")
                ->setAdresseClient("adresse")
                ->setType("particulier"); // Définir le type ici

            $randomUser = $users[array_rand($users)];
            $randomRec = $reclamations[array_rand($reclamations)];

            $particulier->setCommercial($randomUser)
                ->setReclamations($randomRec)
                ->generateCodeClient(); // Appeler la méthode de génération du code client

            $manager->persist($particulier);
        }

        for ($i = 6; $i <= 10; $i++) {
            $commercant = new Commercant();
            $commercant->setNomCompletClient("Client Client")
                ->setEmailClient("client" . $i . "@gmail.com")
                ->setAdresseClient("adresse")
                ->setType("commercant"); // Définir le type ici

            $randomUser = $users[array_rand($users)];
            $randomRec = $reclamations[array_rand($reclamations)];

            $commercant->setCommercial($randomUser)
                ->setReclamations($randomRec)
                ->generateCodeClient(); // Appeler la méthode de génération du code client

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

