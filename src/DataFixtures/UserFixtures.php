<?php

namespace App\DataFixtures;

use App\Entity\TC;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Création de 5 utilisateurs fictifs
        for ($i = 1; $i <= 5; $i++) {
            $user = new TC();
            
        // Génération d'une adresse email unique
        $email = "user{$i}" . uniqid() . "@example.com";
  
            $user->setEmail($email);
            $user->setPassword(password_hash("password{$i}", PASSWORD_BCRYPT)); // Vous pouvez utiliser un mot de passe sécurisé ici
            $user->setRoles(['ROLE_TC']);
            $user->setTelephone("77546222{$i}");
            $user->setNomComplet("Nom Complet {$i}");
           // $user->setStatut("Actif"); // Vous pouvez ajuster le statut selon vos besoins

            $manager->persist($user);
            
        }

        $manager->flush();
    }
        
    public function getDependencies()
    {
        return [
            AppFixtures::class
        ];
    }
}
