<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\Client;
use App\Entity\CA;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use App\Repository\CARepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AchatFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        

        $manager->flush();
    }
   
}
