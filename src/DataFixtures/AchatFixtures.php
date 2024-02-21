<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AchatFixtures extends Fixture
{
    
   private ClientRepository $clientRepo;

   public function __construct(ClientRepository $clientRepo)
   {
        $this->clientRepo = $clientRepo;
   }
    public function load(ObjectManager $manager): void
    {
        $bureaux = ["Beijing", "Shenzeng"];

        $date_string = '2022-01-02';
        $date = new DateTime($date_string);
        // Rechercher tous les clients
        $clients = $this -> clientRepo -> findAll();

        for($i=1; $i<=5; $i++)
        {
            $achat = new Achat;
            $achat -> setDate($date);
            foreach($bureau as $bureaux => $value)
            {
               $achat -> setCodeSortie($value."00".$i);
                        
            
                

        }

        $manager->flush();
    }
}
