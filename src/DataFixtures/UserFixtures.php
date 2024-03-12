<?php

namespace App\DataFixtures;

use App\Entity\TC;
use App\Entity\User;
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
            $user->setEmail("user{$i}@example.com");
            $user->setPassword(password_hash("password{$i}", PASSWORD_BCRYPT)); // Vous pouvez utiliser un mot de passe sécurisé ici
            $user->setRoles(['ROLE_TC']);
            $user->setTelephone("123456789{$i}");
            $user->setNomComplet("Nom Complet {$i}");
           // $user->setStatut("Actif"); // Vous pouvez ajuster le statut selon vos besoins

            $manager->persist($user);
            $this->addReference("user_{$i}", $user); // Ajoute une référence pour une utilisation ultérieure si nécessaire
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
