<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class UserFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {
    $users = ["Zahra Mane", "Farba Diouf", "Aissatou Ndiaye", "Bertrand Moupinga", "Georges Zogo"];
    $usernames = ["zahra", "farba","aissatou","bertrand","georges"];

        if (count($users) == count($usernames))
        {   
            $combined = array_combine($users, $usernames);
        }
       foreach($combined as $users => $usernames)
       {
        for($i=1; $i<=5; $i++)
        {
            $user = new User();
            $user -> setNomComplet($users)
            -> setPassword("123456")
            -> setTelephone("77548641".$i)
            -> setEmail($usernames."@gmail.com");
            
        }
        $manager -> persist($user);
       }
       
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class,
        ];
    }
        
    
}
