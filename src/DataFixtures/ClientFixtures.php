<?php

namespace App\DataFixtures;

use App\Entity\Commercant;
use App\Entity\Particulier;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Repository\ReclamationsRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    // Injection de Dependance
    private UserRepository $userRepo;
    private ReclamationsRepository $recRepo;

    public function __construct(UserRepository $userRepo, ReclamationsRepository $recRepo)
    {
        $this->userRepo = $userRepo;
        $this->recRepo = $recRepo;

    }


    public function load(ObjectManager $manager): void
    {
    
       // Rechercher tous les users & reclamations
        $users = $this -> userRepo -> findAll() ;

        $reclamations = $this -> recRepo -> findAll();

    // Creation de Clients Particulier
        for($i=1; $i<=5; $i++)
        {
                $client = new Particulier;
                $client -> setNomCompletClient("Client Client")
                        -> setEmailClient("client".$i."@gmail.com")
                        -> setAdresseClient("adresse"); 
                        
             // Affecter user et reclamation a un client
            $randomUsers = $users[array_rand($users)];
            $randomRec = $reclamations[array_rand($reclamations)];

            $client -> setCommercial($randomUsers)
                    -> setReclamations($randomRec);

            $manager -> persist($client);    
        }
        for($i=6; $i<=10; $i++)
        {
              // Creation de Clients Commercants
            $client = new Commercant;
            $client -> setNomCompletClient("Client Client")
                    -> setEmailClient("client".$i."@gmail.com")
                    -> setAdresseClient("adresse");
                        
             // Affecter user et reclamation a un client
            $randomUsers = $users[array_rand($users)];
            $randomRec = $reclamations[array_rand($reclamations)];

            $client -> setCommercial($randomUsers)
                    -> setReclamations($randomRec);

            $manager -> persist($client);    
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
