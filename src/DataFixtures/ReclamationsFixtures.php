<?php

namespace App\DataFixtures;


use App\Entity\Reclamations;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\UserRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



 

class ReclamationsFixtures extends Fixture implements DependentFixtureInterface
{
   private UserRepository $repoUser;
    public function __construct( UserRepository $repoUser)
    {
       $this->repoUser = $repoUser;
    }

    public function load(ObjectManager $manager): void
    {
        // Rechercher tous les users
      $users = $this -> repoUser -> findAll();

        // Création de Commerciaux 
        $date_string = '2024-01-01';
        $date = new DateTime($date_string);
        if(!empty($users))
        {
           
            for($i=0; $i<10; $i++)
            {
                $reclamation = new Reclamations;
                $reclamation -> setRefReclamation("REC_".$i)
                            -> setDate($date)
                            -> setType("Remboursement")
                            -> setDescription("")
                            -> setEtat("Traité"); 
            
    
            // Affecter chaque user a une reclamation
            $randomUser = $users[array_rand($users)];
            $reclamation -> setCommercial($randomUser);
    
            $manager -> persist($reclamation);
            
            }
        }
        else
        {
            echo("le tableau est vide");
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

